<?php

namespace App\Http\Controllers;

use App\Models\CekStatusPengaduan;
use App\Models\Pengaduan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CekstatusPengaduanController extends Controller
{
    // Memastikan pengguna adalah warga yang sudah login
    private function pastikanWarga(): void
    {
        abort_unless(
            Auth::check() &&
            Auth::user()->role === 'warga',
            403,
            'Anda tidak memiliki akses ke halaman ini.'
        );
    }

    // =========================================
    // DAFTAR STATUS PENGADUAN WARGA
    // =========================================
    public function index()
    {
        $this->pastikanWarga();

        $pengaduan = CekStatusPengaduan::query()
            ->where('user_id', Auth::id())
            ->latest()
            ->paginate(10);

        return view(
            'warga.index',
            compact('pengaduan')
        );
    }

    // =========================================
    // DETAIL STATUS PENGADUAN
    // =========================================
    public function show(CekStatusPengaduan $pengaduan)
    {
        $this->pastikanWarga();

        abort_unless(
            (int) $pengaduan->user_id === (int) Auth::id(),
            403,
            'Anda tidak dapat melihat pengaduan milik warga lain.'
        );

        $pengaduan->load([
            'user',
            'daftarTanggapan' => function ($query) {
                $query->with('user')->latest();
            },
        ]);

        $tanggapanTerbaru = $pengaduan
            ->daftarTanggapan
            ->first();

        $sudahDitanggapi = $tanggapanTerbaru !== null;

        return view(
            'warga.show',
            compact(
                'pengaduan',
                'tanggapanTerbaru',
                'sudahDitanggapi'
            )
        );
    }

    // =========================================
    // FORM EDIT PENGADUAN
    // Menggunakan Blade warga.create
    // =========================================
    public function edit(CekStatusPengaduan $pengaduan)
    {
        $this->pastikanWarga();

        // Warga hanya boleh edit pengaduannya sendiri
        abort_unless(
            (int) $pengaduan->user_id === (int) Auth::id(),
            403,
            'Anda tidak dapat mengedit pengaduan milik warga lain.'
        );

        // =========================================
        // DATA UNTUK FORM EDIT
        // Menggunakan sumber data yang sama
        // dengan form Buat Pengaduan
        // =========================================
        $jenisPengaduan = Pengaduan::JENIS_PENGADUAN;
        $pilihanRW = Pengaduan::PILIHAN_RW;

        return view(
            'warga.create',
            compact(
                'pengaduan',
                'jenisPengaduan',
                'pilihanRW'
            )
        );
    }

    // =========================================
    // UPDATE PENGADUAN
    // =========================================
    public function update(
        Request $request,
        CekStatusPengaduan $pengaduan
    ) {
        $this->pastikanWarga();

        // Pastikan hanya pemilik yang boleh mengedit
        abort_unless(
            (int) $pengaduan->user_id === (int) Auth::id(),
            403,
            'Anda tidak dapat mengubah pengaduan milik warga lain.'
        );

        $validated = $request->validate([
            'jenis_pengaduan' => [
                'required',
                'string',
                'max:255',
            ],

            'judul' => [
                'required',
                'string',
                'max:255',
            ],

            'isi_pengaduan' => [
                'required',
                'string',
            ],

            'rw' => [
                'required',
                'string',
                'max:255',
            ],

            'lokasi_kejadian' => [
                'nullable',
                'string',
                'max:255',
            ],
        ]);

        /*
         * HANYA field milik warga yang diubah.
         *
         * status TIDAK diubah.
         * tanggapan TIDAK diubah.
         */
        $pengaduan->update([
            'jenis_pengaduan' =>
                $validated['jenis_pengaduan'],

            'judul' =>
                $validated['judul'],

            'isi_pengaduan' =>
                $validated['isi_pengaduan'],

            'rw' =>
                $validated['rw'],

            'lokasi_kejadian' =>
                $validated['lokasi_kejadian'] ?? null,
        ]);

        return redirect()
            ->route('warga.pengaduan.index')
            ->with(
                'success',
                'Pengaduan berhasil diperbarui.'
            );
    }

    // =========================================
    // HAPUS PENGADUAN
    // =========================================
    public function destroy(CekStatusPengaduan $pengaduan)
    {
        $this->pastikanWarga();

        // Pastikan hanya pemilik yang boleh menghapus
        abort_unless(
            (int) $pengaduan->user_id === (int) Auth::id(),
            403,
            'Anda tidak dapat menghapus pengaduan milik warga lain.'
        );

        DB::transaction(function () use ($pengaduan) {

            /*
             * Hapus semua tanggapan yang terkait terlebih dahulu.
             * Jadi tidak meninggalkan data tanggapan di database.
             */
            $pengaduan->daftarTanggapan()->delete();

            // Kemudian hapus pengaduannya
            $pengaduan->delete();
        });

        return redirect()
            ->route('warga.pengaduan.index')
            ->with(
                'success',
                'Pengaduan berhasil dihapus.'
            );
    }
}