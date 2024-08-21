<?php

namespace App\Http\Controllers;

use App\Models\auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth as FacadesAuth;

class AuthController extends Controller
{

    public function index()
    {
        return view('Auth.login');
    }
    public function logincheck(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $logindetail = [
            'email' => $request['email'],
            'password' => $request['password'],
        ];

        if (FacadesAuth::attempt($logindetail)) {
            return redirect()->route('dashboard')->with('success', "Welcome to Admin Dashboard");
        } else {
            return redirect()->back()->with('fail', 'Email Or Password incorrect..! Try Again');
        }
    }
    public function dashboard()
    {
        return view('dashboard');
    }

    public function logout(Request $request)
    {
        FacadesAuth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}
