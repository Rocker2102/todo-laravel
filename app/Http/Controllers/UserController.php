<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        return \view('profile');
    }

    public function updateUser(Request $request) {
        $validator = $request->validateWithBag('updateAcc', [
            'name' => 'required | regex:/^[a-zA-Z\s]*$/ | min:3',
            'email' => 'required | email'
        ]);

        try {
            $user = User::where('id', Auth::id())->first();
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->save();

            return redirect()->back()->with([
                'status' => 'success',
                'message' => 'Profile updated'
            ]);
        } catch (\Exception $e) {
            return back()->withErrors([
                'Internal server error!',
                'Email already taken!'
            ]);
        }
    }

    public function changePassword(Request $request) {
        $validator = $request->validateWithBag('changePwd', [
            'password' => 'required | min:4',
            'new_password' => 'required | confirmed | min:4'
        ]);

        if (! \Hash::check($request->input('password'), Auth::user()->password)) {
            return back()->withErrors([
                '<strong class="text-danger">Incorrect Password!</strong> Failed to change.'
            ]);
        }

        if (\Hash::check($request->input('new_password'), Auth::user()->password)) {
            return back()->withErrors([
                '<strong class="text-danger">New password same as previous!</strong> Unable to update.'
            ]);
        }

        try {
            $user = User::where('id', Auth::id())->first();
            $user->password = \Hash::make($request->input('new_password'));
            $user->save();

            return redirect()->back()->with([
                'status' => 'success',
                'message' => 'Password successfully changed'
            ]);
        } catch (\Exception $e) {
            return back()->withErrors([
                'Internal server error!'
            ]);
        }
    }

    public function deleteUser(Request $request) {
        $validator = $request->validateWithBag('deleteAcc', [
            'password' => 'required | min:4'
        ]);

        if (! \Hash::check($request->input('password'), Auth::user()->password)) {
            return back()->withErrors([
                '<strong class="text-danger">Incorrect Password!</strong> Failed to delete account.'
            ]);
        }

        try {
            $user = User::where('id', Auth::id())->first();
            $user->delete();

            return redirect()->route('logout');
        } catch (\Exception $e) {
            return back()->withErrors([
                'Internal server error!'
            ]);
        }
    }
}
