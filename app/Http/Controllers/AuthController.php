<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Tampilkan halaman login.
     */
    public function login()
    {
        return view('auth.login');
    }

    /**
     * Tampilkan halaman register.
     */
    public function register()
    {
        return view('auth.register');
    }

    /**
     * Proses autentikasi pengguna.
     */
    public function authenticate(Request $request)
    {
        // Validasi input dari pengguna
        $credentials = $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ]);

        // Cek kredensial menggunakan username dan password
        if (Auth::attempt(['username' => $credentials['username'], 'password' => $credentials['password']])) {
            // Regenerasi session setelah login sukses
            $request->session()->regenerate();

            // Redirect ke halaman yang diinginkan setelah login
            return redirect()->intended('/menus');
        }

        // Jika login gagal, kembali dengan pesan error
        return back()->withErrors([
            'username' => 'The provided credentials do not match our records.',
        ]);
    }

    /**
     * Proses registrasi pengguna baru.
     */
    public function store(Request $request)
    {
        // Validasi data yang dikirimkan oleh pengguna
        $validate = $request->validate([
            'name' => 'required',
            'username' => 'required|unique:users,username', // Validasi username unik
            'password' => 'required|confirmed', // Validasi password yang dikonfirmasi
            'role' => 'required|string|in:admin,user',
        ]);

        // Enkripsi password sebelum menyimpan ke database
        $validate['password'] = Hash::make($request->password);

        // Buat user baru
        User::create($validate);

        // Redirect ke halaman login setelah registrasi
        return redirect('/login');
    }

    /**
     * Proses logout pengguna.
     */
    public function logout(Request $request)
    {
        // Logout pengguna
        Auth::logout();

        // Hapus session dan token
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Redirect ke halaman login setelah logout
        return redirect('/login');
    }
}
