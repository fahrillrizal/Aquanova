<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class PasswordController extends Controller
{
    public function showLinkRequestForm()
    {
        return view('auth.forgot-password');
    }

    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $response = Password::sendResetLink($request->only('email'));

        return $response == Password::RESET_LINK_SENT
            ? back()->with('status', trans($response))
            : back()->withErrors(['email' => trans($response)]);
    }

    public function showResetForm(Request $request, $token = null)
    {
        return view('auth.reset-password')->with(
            ['token' => $token, 'email' => $request->email]
        );
    }

    public function reset(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => [
                'required',
                'confirmed',
                'min:8',
                'regex:/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[@$!%*?&]).*$/', // Memastikan ada huruf besar, huruf kecil, angka, dan simbol
            ],
            'token' => 'required',
        ]);

        // Anda bisa mengganti cara menyimpan password di sini
        $user = \App\Models\User::where('email', $request->email)->first();

        if ($user) {
            $user->password = $request->password; // Simpan password baru tanpa hashing
            $user->save();
        }

        return redirect()->route('login')->with('status', trans(Password::PASSWORD_RESET));
    }
}
