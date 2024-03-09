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

        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if(Auth::attempt($credentials)) {
            return redirect()->route('dashboard')->withSuccess('User login successfully.');
        } else {
            return redirect()->route('login')->withError('The provided credentials do not match our records.');
        }

        // dd($request->all());

        // return view('admin.dashboard');
    }

    public function logout() {
        Auth::logout();
        return redirect()->route('login')->withSuccess('You are successfully logged out');
    }

}
