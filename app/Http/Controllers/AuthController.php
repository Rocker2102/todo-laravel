<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function authenticate(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required | email',
            'password' => 'required | min:4'
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->route('app.home')->with([
                'status' => 'success',
                'message' => 'Logged in'
            ]);
        }

        return back()->withErrors([
            'The provided credentials do not match any records'
        ])->withInput(
            $request->except('password')
        );
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('app.login')->with([
            'status' => 'info',
            'message' => 'Logged out!'
        ]);;
    }
}
