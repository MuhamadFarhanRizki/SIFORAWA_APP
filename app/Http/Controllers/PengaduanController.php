<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use App\Models\Tanggapan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class PengaduanController extends Controller
{
    // =========================================
    // MEMERIKSA ROLE PENGGUNA
    // =========================================
    private function pastikanRole(string $role): void
    {
        abort_unless(
            Auth::check() && Auth::user()->role === $role,
            403,
            'Anda tidak memiliki akses ke halaman ini.'
        );
    }

    // =========================================
    // WARGA: FORM BUAT PENGADUAN
    // =========================================
    public function create()
    {
        $this->pastikanRole('warga');

        $jenisPengaduan = Pengaduan::JENIS_PENGADUAN;
        $pilihanRW = Pengaduan::PILIHAN_RW;

        return view('warga.create', compact(
            'jenisPengaduan',
            'pilihanRW'
        ));
    }

    // =========================================
    // WARGA: SIMPAN PENGADUAN
    // =========================================
    public function store(Request $request)
    {
        $this->pastikanRole('warga');

        $validated = $request->validate([
            'jenis_pengaduan' => [
                'required',
                Rule::in(Pengaduan::JENIS_PENGADUAN),
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
                Rule::in(Pengaduan::PILIHAN_RW),
            ],
            'lokasi_kejadian' => [
                'nullable',
                'string',
            ],
        ], [
            'jenis_pengaduan.required' =>
                'Silakan pilih jenis pengaduan.',
            'jenis_pengaduan.in' =>
                'Jenis pengaduan tidak valid.',
            'judul.required' =>
                'Judul pengaduan wajib diisi.',
            'isi_pengaduan.required' =>
                'Isi pengaduan wajib diisi.',
            'rw.required' =>
                'Silakan pilih RW.',
            'rw.in' =>
                'Pilihan RW tidak valid.',
        ]);

        $validated['user_id'] = Auth::id();
        $validated['status'] = 'diajukan';

        Pengaduan::create($validated);

        return redirect()
            ->route('warga.pengaduan.index')
            ->with('success', 'Pengaduan berhasil dikirim.');
    }

    // =========================================
    // WARGA: DAFTAR PENGADUAN MILIKNYA
    // =========================================
    public function indexWarga()
    {
        $this->pastikanRole('warga');

        $pengaduan = Pengaduan::where('user_id', Auth::id())
            ->with('tanggapan.user')
            ->latest()
            ->paginate(10);

        return view('warga.index', compact('pengaduan'));
    }

    // =========================================
    // WARGA: DETAIL PENGADUAN MILIKNYA
    // =========================================
    public function showWarga(Pengaduan $pengaduan)
    {
        $this->pastikanRole('warga');

        abort_unless(
            $pengaduan->user_id === Auth::id(),
            403,
            'Anda tidak dapat melihat pengaduan milik warga lain.'
        );

        $pengaduan->load('tanggapan.user');

        return view('warga.show', compact('pengaduan'));
    }

    // =========================================
    // ADMIN: DAFTAR SEMUA PENGADUAN
    // =========================================
    public function indexAdmin()
    {
        $this->pastikanRole('admin');

        $pengaduan = Pengaduan::with('user')
            ->with('tanggapan.user')
            ->latest()
            ->paginate(10);

        return view('admin.index', compact('pengaduan'));
    }

    // =========================================
    // ADMIN: DETAIL PENGADUAN
    // =========================================
    public function showAdmin(Pengaduan $pengaduan)
    {
        $this->pastikanRole('admin');

        $pengaduan->load([
            'user',
            'tanggapan.user',
        ]);

        $statusPengaduan = Pengaduan::STATUS_PENGADUAN;

        return view(
            'admin.show',
            compact('pengaduan', 'statusPengaduan')
        );
    }

    // =========================================
    // ADMIN: SIMPAN PERUBAHAN STATUS
    // Route: admin.pengaduan.update
    // =========================================
    public function updateStatusAdmin(
        Request $request,
        Pengaduan $pengaduan
    ) {
        $this->pastikanRole('admin');

        $validated = $request->validate([
            'status' => [
                'required',
                Rule::in(Pengaduan::STATUS_PENGADUAN),
            ],
        ], [
            'status.required' =>
                'Silakan pilih status pengaduan.',
            'status.in' =>
                'Status pengaduan tidak valid.',
        ]);

        $pengaduan->update([
            'status' => $validated['status'],
        ]);

        return redirect()
            ->route('admin.pengaduan.show', $pengaduan->id)
            ->with(
                'success',
                'Status pengaduan berhasil diperbarui.'
            );
    }

    // =========================================
    // ADMIN: SIMPAN TANGGAPAN BARU
    // Route: admin.pengaduan.tanggapan.store
    // =========================================
    public function storeTanggapanAdmin(
        Request $request,
        Pengaduan $pengaduan
    ) {
        $this->pastikanRole('admin');

        $validated = $request->validate([
            'tanggapan' => [
                'required',
                'string',
                'max:5000',
            ],
        ], [
            'tanggapan.required' =>
                'Tanggapan admin wajib diisi.',
            'tanggapan.max' =>
                'Tanggapan maksimal 5000 karakter.',
        ]);

        Tanggapan::create([
            'pengaduan_id' => $pengaduan->id,
            'user_id' => Auth::id(),
            'tanggapan' => $validated['tanggapan'],
        ]);

        return redirect()
            ->route('admin.pengaduan.show', $pengaduan->id)
            ->with(
                'success',
                'Tanggapan berhasil dikirim kepada warga.'
            );
    }

    // =========================================
    // ADMIN: EDIT TANGGAPAN LAMA
    // Route: admin.pengaduan.tanggapan.update
    // =========================================
    public function updateTanggapanAdmin(
        Request $request,
        Pengaduan $pengaduan,
        Tanggapan $tanggapan
    ) {
        $this->pastikanRole('admin');

        // Pastikan tanggapan memang milik pengaduan ini.
        abort_unless(
            (int) $tanggapan->pengaduan_id === (int) $pengaduan->id,
            404,
            'Tanggapan tidak ditemukan pada pengaduan ini.'
        );

        $validated = $request->validate([
            'tanggapan' => [
                'required',
                'string',
                'max:5000',
            ],
        ], [
            'tanggapan.required' =>
                'Tanggapan admin wajib diisi.',
            'tanggapan.max' =>
                'Tanggapan maksimal 5000 karakter.',
        ]);

        $tanggapan->update([
            'tanggapan' => $validated['tanggapan'],
        ]);

        return redirect()
            ->route('admin.pengaduan.show', $pengaduan->id)
            ->with(
                'success',
                'Tanggapan berhasil diperbarui.'
            );
    }

    // =========================================
    // ADMIN: HAPUS TANGGAPAN
    // Route: admin.pengaduan.tanggapan.destroy
    // =========================================
    public function destroyTanggapanAdmin(
        Pengaduan $pengaduan,
        Tanggapan $tanggapan
    ) {
        $this->pastikanRole('admin');

        // Pastikan tanggapan memang milik pengaduan ini.
        abort_unless(
            (int) $tanggapan->pengaduan_id === (int) $pengaduan->id,
            404,
            'Tanggapan tidak ditemukan pada pengaduan ini.'
        );

        $tanggapan->delete();

        return redirect()
            ->route('admin.pengaduan.show', $pengaduan->id)
            ->with(
                'success',
                'Tanggapan berhasil dihapus.'
            );
    }

    // =========================================
    // ADMIN: TAMBAH TANGGAPAN DAN UBAH STATUS
    // Dipertahankan untuk form gabungan
    // =========================================
    public function updateAdmin(
        Request $request,
        Pengaduan $pengaduan
    ) {
        $this->pastikanRole('admin');

        $validated = $request->validate([
            'tanggapan' => [
                'required',
                'string',
            ],
            'status' => [
                'required',
                Rule::in(Pengaduan::STATUS_PENGADUAN),
            ],
        ], [
            'tanggapan.required' =>
                'Tanggapan admin wajib diisi.',
            'status.required' =>
                'Silakan pilih status pengaduan.',
            'status.in' =>
                'Status pengaduan tidak valid.',
        ]);

        DB::transaction(function () use (
            $validated,
            $pengaduan
        ) {
            Tanggapan::create([
                'pengaduan_id' => $pengaduan->id,
                'user_id' => Auth::id(),
                'tanggapan' => $validated['tanggapan'],
            ]);

            $pengaduan->update([
                'status' => $validated['status'],
            ]);
        });

        return redirect()
            ->route('admin.pengaduan.show', $pengaduan->id)
            ->with(
                'success',
                'Tanggapan dan status pengaduan berhasil disimpan.'
            );
    }

    // =========================================
    // ADMIN: RIWAYAT PENGADUAN YANG SELESAI
    // Route: admin.riwayat.index
    // =========================================
    public function riwayatAdmin(Request $request)
    {
        $this->pastikanRole('admin');

        $cari = trim($request->query('search', ''));

        $pengaduan = Pengaduan::query()
            ->with('user')
            ->where('status', 'selesai')
            ->when($cari !== '', function ($query) use ($cari) {
                $query->where(function ($subQuery) use ($cari) {
                    $subQuery->where('judul', 'like', '%' . $cari . '%')
                        ->orWhere('jenis_pengaduan', 'like', '%' . $cari . '%');
                });
            })
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('admin.riwayatpengaduan', compact(
            'pengaduan',
            'cari'
        ));
    }
}

