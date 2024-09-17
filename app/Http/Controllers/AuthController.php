<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
// use App\Notifications\UserRegisteredMail;

class AuthController extends Controller
{
    // Menampilkan formulir pendaftaran
    public function showRegisterForm()
    {
        return view('regis');
    }

    // Menangani pendaftaran pengguna baru
    public function regis(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            // 'password' => 'required|string|min:8|confirmed|regex:/^(?=.*[A-Z])(?=.*[0-9]).*$/', iki regex hapusen comment e lek fix lek testing ojok, ribet
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Kirim notifikasi email
        // $user->notify(new UserRegisteredMail($user));

        return redirect()->route('profile')->with('success', 'Registration successful. Please check your email and login.');
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
            return redirect()->intended('dashboard')->with('success', 'You are logged in!');
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

        return redirect('/login')->with('success', 'You have been logged out.');
    }
}
