<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    /**
     * Menampilkan halaman login.
     */
    public function showLogin()
    {
        return view('auth.login');
    }

    /**
     * Proses login Admin dan Warga.
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required|string',
            'no_telepon' => 'required|string',
            'password' => 'required|string',
            'role' => 'required|in:admin,warga',
        ]);

        $loginBerhasil = Auth::attempt([
            'username' => $credentials['username'],
            'no_telepon' => $credentials['no_telepon'],
            'password' => $credentials['password'],
            'role' => $credentials['role'],
        ]);

        if ($loginBerhasil) {
            $request->session()->regenerate();

            if (Auth::user()->role === 'admin') {
                return redirect()->route('admin.dashboard');
            }

            return redirect()->route('warga.dashboard');
        }

        return back()
            ->withErrors([
                'username' => 'Data login tidak sesuai.',
            ])
            ->withInput($request->only(
                'username',
                'no_telepon'
            ));
    }

    /**
     * Menampilkan halaman register warga.
     */
    public function showRegister()
    {
        return view('auth.register');
    }

    /**
     * Proses registrasi warga tanpa konfirmasi password.
     */
    public function register(Request $request)
    {
        $validated = $request->validate([
            'username' => 'required|string|max:50|unique:users,username',
            'password' => 'required|string|min:6',
            'no_telepon' => 'required|string|max:20',
        ], [
            'username.required' => 'Username wajib diisi.',
            'username.max' => 'Username maksimal 50 karakter.',
            'username.unique' => 'Username sudah digunakan.',

            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal 6 karakter.',

            'no_telepon.required' => 'Nomor telepon wajib diisi.',
            'no_telepon.max' => 'Nomor telepon maksimal 20 karakter.',
        ]);

        // Membuat akun warga dan mengamankan password.
        $user = User::create([
            'username' => $validated['username'],
            'password' => Hash::make($validated['password']),
            'no_telepon' => $validated['no_telepon'],
            'role' => 'warga',
        ]);

        // Login otomatis setelah registrasi berhasil.
        Auth::login($user);

        // Membuat session baru.
        $request->session()->regenerate();

        // Mengarahkan pengguna ke dashboard warga.
        return redirect()->route('warga.dashboard')
            ->with('success', 'Registrasi berhasil. Selamat datang!');
    }

    /**
     * Logout Admin maupun Warga.
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
