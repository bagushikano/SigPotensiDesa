<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Model\Admin;

class LoginController extends Controller
{
    // Access only on API
    public function register(Request $request)
    {
        $admin = Admin::create([
            'username' => $request->username,
            'password' => bcrypt($request->password),
        ]);

        if ($admin) {
            return ('Sukses');
        } else {
            return ('Gagal');
        }
    }

    public function loginForm()
    {
        return view('admin/auth/login');
    }

    public function login(Request $request)
    {
        if(Auth::guard()->attempt(['username' => $request->username, 'password' => $request->password])){
            return redirect()->intended('dashboard');
        } else {
            return redirect()->back()->with('message', 'Email atau Password Anda Salah');
        }
    }

    public function logout()
    {
        Auth::guard()->logout();

        return redirect()->route('Login Form');
    }
}
