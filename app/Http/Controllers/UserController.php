<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class UserController extends Controller
{
    private $validate = [
        'name' => 'required | regex:/^[a-zA-Z\s]*$/ | min:3',
        'email' => 'required | email',
        'pwd' => 'required | min:4',
        'pwd_confirmed' => 'required | confirmed | min:4'
    ];

    public function addUser(Request $request) {
        $validator = $request->validate([
            'name' => $this->validate['name'],
            'email' => $this->validate['email'],
            'password' => $this->validate['pwd_confirmed']
        ]);

        try {
            $user = new User;
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->password = \Hash::make($request->input('password'));
            $user->save();

            return redirect()->route('app.login')->with([
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
            'name' => $this->validate['name'],
            'email' => $this->validate['email']
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
            'password' => $this->validate['pwd'],
            'new_password' => $this->validate['pwd_confirmed']
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
            'password' => $this->validate['pwd']
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
