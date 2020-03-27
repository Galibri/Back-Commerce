<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function dashboard() {
        return view('admin.dashboard');
    }

    public function login(Request $request) {
        if( $request->isMethod('post') ) {

            $rules = [
                'email' => 'required|email',
                'password' => 'required|min:6'
            ];

            $customMessages = [
                'email.required' => 'Email is required',
                'email.email' => 'Valid email is required',
                'password.required' => 'Password cannot be empty.',
            ];

            $this->validate($request, $rules, $customMessages);

            $credentials = [
                'email' => $request->email,
                'password' => $request->password,
                'status' =>  1,
            ];

            if( Auth::guard('admin')->attempt($credentials, $request->get('remember')) ) {
                return redirect()->intended(route('admin.dashboard'));
            } else {
                Session::flash('login_error', 'Incorrect Credentials!');
                return back()->withInput($request->only('email', 'remember'));
            }
        }
        return view('admin.login');
    }

    public function logout() {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }

    public function profile(Admin $admin) {
        $profile = $admin;
        return view('admin.users.profile', compact('profile'));
    }

    public function updateProfile(Request $request, Admin $admin) {
        $rules = [
            'email' => 'required|email',
            'name' => 'required',
            'password' => 'confirmed|nullable',
        ];

        $request->validate($rules);

        if($request->input('password') != null) {
            $data = [
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'password' => bcrypt($request->input('password')),
            ];
            $admin->update($data);
            return back()->with('success', 'Profile changed successfully!');
        }

        $data = [
            'name' => $request->input('name'),
            'email' => $request->input('email'),
        ];
        $admin->update($data);
        return back()->with('success', 'Profile changed successfully!');
    }

}
