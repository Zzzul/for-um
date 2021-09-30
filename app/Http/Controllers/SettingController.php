<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class SettingController extends Controller
{
    public function index()
    {
        return view('users.settings.index');
    }

    public function changeProfile(Request $request)
    {
        $request->validate([
            'name' => 'required|string|min:5|max:50',
            'email' => 'required|email|unique:users,email,' . auth()->id(),
            'avatar' => 'nullable|image|max:1024'
        ]);

        if ($request->file('avatar')->isValid()) {
            $filename = strtolower(Str::random(20))  . '.' . $request->avatar->extension();

            $request->avatar->storeAs('public/img/avatar/', $filename);

            // delete old avatar from storage
            if (auth()->user()->avatar != null) {
                Storage::delete('public/img/avatar/' . auth()->user()->avatar);
            }

            auth()->user()->update(['avatar' => $filename]);
        }

        auth()->user()->update([
            'name' => $request->name,
            'email' => $request->email
        ]);

        return redirect()->back()->with('success', 'Profile updated.');
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|min:5|same:password_confirmation',
        ]);

        // Check current password
        if (Hash::check($request->current_password, auth()->user()->password)) {

            auth()->user()->update([
                'password' => bcrypt($request->password)
            ]);

            return redirect()->back()->with('success', 'Password chnged.');

            // dd(1);
        } else {
            // dd(2);
            return redirect()->back()->with('error', 'Wrong old password.');
        }
    }
}
