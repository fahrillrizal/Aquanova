<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SocialiteController extends Controller
{
    // Function googleLogin
    public function googleLogin()
    {
        return Socialite::driver('google')->redirect();
    }
    //

    public function googleAuthentication()
    {
        try {
            // Retrieve the authenticated Google user
            $googleUser = Socialite::driver('google')->user();

            // Check if the user is already logged in
            if (Auth::check()) {
                $currentUser = Auth::user();

                // Check if the current user already has a Google ID
                if ($currentUser->google_id === null) {
                    $currentUser->google_id = $googleUser->id;
                    $currentUser->save();
                    return redirect()->route('profile')->with('success', 'Google account linked successfully.');
                } else {
                    // If Google ID already exists
                    return redirect()->route('profile')->with('error', 'Your account is already linked to a Google account.');
                }
            }

            // Find a user by Google ID
            $user = User::where('google_id', $googleUser->id)->first();

            if ($user) {
                // Log in the user if they already exist
                Auth::login($user);
                return redirect()->route('/');
            } else {
                // If no user is found, create a new user with Google details
                $userData = User::create([
                    'name' => $googleUser->name,
                    'email' => $googleUser->email,
                    'password' => Hash::make('Password@1234'), // Default password
                    'google_id' => $googleUser->id,
                ]);

                Auth::login($userData);
                return redirect()->route('profile');
            }
        } catch (\Exception $e) {
            // Handle exceptions and errors
            return redirect()->route('login')->with('error', 'Something went wrong while authenticating with Google.');
        }
    }
}
