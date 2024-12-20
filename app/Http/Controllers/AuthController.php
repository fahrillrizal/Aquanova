<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Menampilkan formulir pendaftaran
    public function showRegisterForm()
    {
        return view('regis'); // View 'regis.blade.php' di dalam folder 'views'
    }

    // Menangani pendaftaran pengguna baru
    public function regis(Request $request)
    {
        // $request->validate([
        //     'name' => 'required|string|max:255',
        //     'email' => 'required|string|email|max:255|unique:users',
        //     'password' => [
        //         'required',
        //         'string',
        //         'min:8',
        //         'confirmed',
        //         'regex:/^(?=.*[A-Z])(?=.*[0-9]).*$/',
        //     ],
        // ], [
        //     'password.regex' => 'Password must contain at least one uppercase letter, one lowercase letter, and one number.',
        //     'email.regex' => 'Email must be a valid Gmail or Yahoo address.',
        // ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('login')->with('success', 'Registrasi berhasil.');
    }

    // Menampilkan formulir login
    public function showLoginForm()
    {
        return view('login');
    }

    // Menangani login pengguna
    public function login(Request $request)
    {
        // Validasi data yang masuk
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Coba untuk login
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/')->with('success', 'Login berhasil!');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    // Menangani logout pengguna
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('login')->with('success', 'You have been logged out.');
    }
}