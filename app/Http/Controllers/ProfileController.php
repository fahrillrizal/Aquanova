<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function profile(){
        $user = Auth::user();
        return view('profile', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        $user->full_name = $request->input('full_name');
        $user->name = $request->input('nickname');
        $user->address = $request->input('address');
        $user->hp = $request->input('hp');
        $user->save();

        return redirect()->back()->with('status', 'Profil berhasil diubah.');
    }

    public function updatePP(Request $request)
    {
        $request->validate([
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user = Auth::user();
        if ($user->foto) {
            Storage::delete('public/pp/' . $user->foto);
        }

        $photo = $request->file('photo');
        $filename = time() . '.' . $photo->getClientOriginalExtension();
        $photo->storeAs('public/pp', $filename);

        $user->foto = $filename;
        $user->save();

        return redirect()->back()->with('status', 'Foto profil berhasil diubah.');
    }

    public function hapusPP()
    {
        $user = Auth::user();
        if ($user->foto) {
            Storage::delete('public/pp/' . $user->foto);
            $user->foto = null;
            $user->save();
        }

        return redirect()->back()->with('status', 'Foto Profile berhasil dihapus.');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|confirmed|min:8',
        ]);

        $user = Auth::user();
        if (!Hash::check($request->input('current_password'), $user->password)) {
            return redirect()->back()->withErrors(['current_password' => 'Current password is incorrect.']);
        }

        $user->password = Hash::make($request->input('new_password'));
        $user->save();

        return redirect()->back()->with('status', 'Password berhasil diubah.');
    }
}
