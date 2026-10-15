<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function dashboard()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        if (!Auth::user()->isAdmin()) {
            return redirect()->route('warga.dashboard');
        }

        // Menghitung seluruh pengaduan dari semua warga.
        $totalPengaduan = Pengaduan::count();

        // Menghitung pengaduan berdasarkan status database.
        $pengaduanDiajukan = Pengaduan::where(
            'status', 'diajukan'
        )->count();

        $pengaduanDiverifikasi = Pengaduan::where(
            'status', 'diverifikasi'
        )->count();

        $pengaduanDiproses = Pengaduan::where(
            'status', 'diproses'
        )->count();

        $pengaduanDitanggapi = Pengaduan::where(
            'status', 'ditanggapi'
        )->count();

        $pengaduanSelesai = Pengaduan::where(
            'status', 'selesai'
        )->count();

        // Mengambil maksimal 4 pengaduan terbaru.
        $pengaduanTerbaru = Pengaduan::with('user')
            ->latest()
            ->take(4)
            ->get();

        return view('admin.dashboard', compact(
            'totalPengaduan',
            'pengaduanDiajukan',
            'pengaduanDiverifikasi',
            'pengaduanDiproses',
            'pengaduanDitanggapi',
            'pengaduanSelesai',
            'pengaduanTerbaru'
        ));
    }
}