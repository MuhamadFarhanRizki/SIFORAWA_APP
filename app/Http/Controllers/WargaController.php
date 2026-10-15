<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class WargaController extends Controller
{
    /**
     * Dashboard warga
     */
    public function dashboard()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        if (!Auth::user()->isWarga()) {
            return redirect()->route('admin.dashboard');
        }

        $user = Auth::user();

        // Statistik pengaduan milik warga yang sedang login.
        // Query ini hanya mengambil pengaduan milik warga tersebut.
        $pengaduanSaya = $user->pengaduan();

        // Total semua pengaduan
        $totalPengaduan = (clone $pengaduanSaya)->count();

        // Pengaduan diajukan
        $pengaduanDiajukan = (clone $pengaduanSaya)
            ->where('status', 'diajukan')
            ->count();

        // Pengaduan diverifikasi
        $pengaduanDiverifikasi = (clone $pengaduanSaya)
            ->where('status', 'diverifikasi')
            ->count();

        // Pengaduan sedang diproses
        $pengaduanDiproses = (clone $pengaduanSaya)
            ->where('status', 'diproses')
            ->count();

        // Pengaduan sudah ditanggapi
        $pengaduanDitanggapi = (clone $pengaduanSaya)
            ->where('status', 'ditanggapi')
            ->count();

        // Pengaduan selesai
        $pengaduanSelesai = (clone $pengaduanSaya)
            ->where('status', 'selesai')
            ->count();

        // Empat pengaduan terbaru milik warga
        $pengaduanTerbaru = (clone $pengaduanSaya)
            ->latest()
            ->take(4)
            ->get();

        return view('warga.dashboard', compact(
            'user',
            'totalPengaduan',
            'pengaduanDiajukan',
            'pengaduanDiverifikasi',
            'pengaduanDiproses',
            'pengaduanDitanggapi',
            'pengaduanSelesai',
            'pengaduanTerbaru'
        ));
    }

    /**
     * Halaman profil warga
     */
    public function profile()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        if (!Auth::user()->isWarga()) {
            return redirect()->route('admin.dashboard');
        }

        $user = Auth::user();

        return view('warga.profil', compact('user'));
    }
}