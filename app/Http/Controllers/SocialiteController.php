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


    public function googleLogin(){
        return Socialite::driver('google')->redirect();
    }
    //

    public function googleAuthentication(){
        try{
            $googleUser = Socialite::driver('google')->user();
        
        $user = User::where('google_id', $googleUser->id)->first();

        if ($user) {
            # code...
            Auth::login($user);
            return redirect()->route('profile');
        }else{
           $userData =  User::create([
                'name' => $googleUser->name,
                'email' => $googleUser->email,
                'password' => Hash::make('Password@1234'),
                'google_id' => $googleUser->id,
            ]);
            if ($userData) {
                # code...
                Auth::login($userData);
                return redirect()->route('profile');
            }
        }

        }catch(\Exception $e){
            dd($e);
        }



        

    }
}
