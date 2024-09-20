<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;

class GoogleController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        $user = Socialite::driver('google')->user();
        
        // Cari atau buat pengguna di database
        $existingUser = User::where('email', $user->getEmail())->first();
        
        if ($existingUser) {
            Auth::login($existingUser);
        } else {
            // Buat pengguna baru jika belum ada
            $newUser = User::create([
                'name' => $user->getName(),
                'email' => $user->getEmail(),
                'password' => bcrypt('password'),
            ]);

            Auth::login($newUser);
        }
        
        return redirect()->route('home'); // Ganti dengan route setelah login
    }
}
