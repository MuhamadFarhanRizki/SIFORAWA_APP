<?php

namespace App\Http\Controllers;

use App\Models\Profil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfilController extends Controller
{
    /**
     * Menampilkan halaman profil warga.
     */
    public function index()
    {
        $profil = Profil::findOrFail(Auth::id());

        // Halaman ini khusus untuk warga.
        if ($profil->role !== 'warga') {
            abort(403, 'Anda tidak memiliki akses ke halaman ini.');
        }

        $judulProfil = 'Profil';

        return view('warga.profil', compact(
            'profil',
            'judulProfil'
        ));
    }

    /**
     * Menampilkan halaman profil admin.
     */
    public function adminIndex()
    {
        $profil = Profil::findOrFail(Auth::id());

        // Halaman ini khusus untuk admin.
        if ($profil->role !== 'admin') {
            abort(403, 'Anda tidak memiliki akses ke halaman ini.');
        }

        $judulProfil = 'Profil Admin';

        return view('admin.profil', compact(
            'profil',
            'judulProfil'
        ));
    }

    /**
     * Mengganti password pengguna yang sedang login.
     */
    public function updatePassword(Request $request)
    {
        $request->validate([
            'password_lama' => [
                'required',
                'current_password',
            ],
            'password_baru' => [
                'required',
                'string',
                'min:8',
                'confirmed',
            ],
        ], [
            'password_lama.required' =>
                'Password lama wajib diisi.',
            'password_lama.current_password' =>
                'Password lama tidak sesuai.',
            'password_baru.required' =>
                'Password baru wajib diisi.',
            'password_baru.min' =>
                'Password baru minimal 8 karakter.',
            'password_baru.confirmed' =>
                'Konfirmasi password baru tidak cocok.',
        ]);

        $profil = Profil::findOrFail(Auth::id());

        $profil->password = Hash::make(
            $request->password_baru
        );

        $profil->save();

        return redirect()
            ->back()
            ->with('success', 'Password berhasil diperbarui.');
    }
}
