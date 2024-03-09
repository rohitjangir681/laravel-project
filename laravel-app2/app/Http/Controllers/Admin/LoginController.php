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
        // dd($request->all());
        $validate = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if(Auth::attempt($validate)) {
            return redirect()->route('dashboard');
        } else {
            return redirect()->route('login')->withError('The provided credentials do not match our records');
        }
    }

    public function logout() {
        Auth::logout();
        return redirect()->route('login');
    }
}
