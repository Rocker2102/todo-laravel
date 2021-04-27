<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
// use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserController extends Controller
{
    public function addUser(Request $request) {
        $validator = $request->validate([
            'name' => 'required | regex:/^[a-zA-Z\s]*$/ | min:3',
            'email' => 'required | email',
            'password' => 'required | confirmed | min:4'
        ]);

        try {
            $user = new User;
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->password = \Hash::make($request->input('password'));
            $user->save();

            return redirect()->route('login')->with([
                'status' => 'success',
                'message' => 'Registration Successful!'
            ]);
        } catch (\Exception $e) {
            return back()->withErrors([
                'Internal server error!',
                'Email already taken!'
            ])->withInput(
                $request->except(['password', 'password_confirmation'])
            );
        }
    }

    public function getUser() {
        return User::where('id', Auth::id())->get();
    }

    public function updateUser(Request $request) {
        return 'Update';
    }

    public function deleteUser(Request $request) {
        $validator = $request->validate([
            'password' => 'required | min:4'
        ]);

        if (! \Hash::check(\Hash::make($request->input('password')), Auth::user()->password)) {
            return redirect()->route('app')->with([
                'status' => 'danger',
                'message' => 'Incorrect Password!'
            ]);
        }

        try {
            $user = User::where('id', Auth::id());
            $user->delete();

            return redirect()->route('logout');
        } catch (\Exception $e) {
            return back()->withErrors([
                'Internal server error!'
            ]);
        }
    }
}
