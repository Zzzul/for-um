<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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
            'email' => 'required|email|unique:users,email,' . auth()->id()
        ]);

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
        } else {
            return redirect()->back()->with('error', 'Wrong old password.');
        }
    }
}
