<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Notifications\UserRegisteredNotification;

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
        // Validasi data yang masuk
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => [
                'required',
                'string',
                'min:8', // Minimal 8 karakter
                'confirmed',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).+$/', // Aturan regex
            ],
        ], [
            'password.regex' => 'Password must contain at least one uppercase letter, one lowercase letter, one number, and one special character.',
        ]);

        // Membuat pengguna baru
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Kirim notifikasi email
        $user->notify(new UserRegisteredNotification($user));

        // Redirect ke halaman login setelah berhasil mendaftar
        return redirect()->route('login')->with('success', 'Registration successful. Please check your email and login.');
    }

    // Menampilkan formulir login
    public function showLoginForm()
    {
        return view('login'); // View 'login.blade.php' di dalam folder 'views'
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
            // Regenerasi sesi untuk mencegah serangan session fixation
            $request->session()->regenerate();

            // Redirect ke halaman dashboard atau halaman yang diinginkan
            return redirect()->intended('dashboard')->with('success', 'You are logged in!');
        }

        // Jika login gagal, kembalikan ke halaman login dengan pesan error
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

        return redirect('/')->with('success', 'You have been logged out.');
    }
}
