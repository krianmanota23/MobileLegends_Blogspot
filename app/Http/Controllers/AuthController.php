<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    // Show login page
    public function showLogin()
    {
        if (session('admin_logged_in')) {
            return redirect()->route('admin.posts.index');
        }
        return view('auth.login');
    }

    // Handle login form submission
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        // Static credentials — change these to whatever you want
        $validUsername = 'mladmin';
        $validPassword = 'mobilelegends2026';

        if (
            $request->username === $validUsername &&
            $request->password === $validPassword
        ) {
            session(['admin_logged_in' => true]);
            return redirect()->route('admin.posts.index')
                             ->with('success', 'Welcome back, Admin!');
        }

        return back()->withErrors([
            'username' => 'Invalid username or password.',
        ]);
    }

    // Handle logout
    public function logout(Request $request)
    {
        $request->session()->forget('admin_logged_in');
        return redirect()->route('login')
                         ->with('success', 'You have been logged out.');
    }
}
