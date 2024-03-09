<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{
    public function index() {
        return view('admin.login.index');
    }

    public function login(Request $request) {
        
        // $loginData = $request->only('email', 'password');
        
        $validate = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // dd($loginData);

        if(Auth::attempt($validate)) {
            return redirect()->route('dashboard')->withSuccess('You are successfully login.');
        } else {
            return redirect()->route('login')->withError('Credentials is not matched! Please try again.');
        }


    }

    public function logout() {
        Auth::logout();
        return redirect()->route('login')->withSuccess('You are successfully logged out');
    }
}
