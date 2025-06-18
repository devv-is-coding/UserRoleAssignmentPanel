<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        if (Session::has('loggedInAdmin')) {
            return redirect()->route('admin.dashboard');
        }
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'email' => 'required|email',
            'password' => 'required|string',
        ]);
        $admin = Admin::where(function ($query) use ($request) {
            $query->where('username', $request->username)->orWhere('email', $request->email);
        })->first();


        if ($admin && Hash::check($request->password, $admin->password)) {
            Auth::login($admin);
            Session::put('loggedInAdmin', $admin->id);
            Session::regenerate();
            return redirect()->route('admin.dashboard')->with('success', 'Welcome back, Admin!');
        }

        return redirect()->back()->with('error', 'Invalid credentials.');
    }

    public function logout()
    {
        Auth::logout();
        Session::flush();
        Session::pull('loggedInAdmin');
        Session::forget('loggedInAdmin');
        return redirect('/login')->with('success', 'Logged out successfully.');
    }
}
