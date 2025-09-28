<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Admin;

class LoginController extends Controller
{
    // ✅ Show login form
    public function show()
    {
        return view('login'); // Make sure your Blade file is: resources/views/login.blade.php
    }

    // ✅ Combined Login for Admin or Member (based on role)
    public function combinedLogin(Request $request)
    {
        $request->validate([
            'role' => 'required|in:admin,member',
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if ($request->role === 'admin') {
            // 🔐 Admin login
            $admin = Admin::where('email', $request->email)->first();

            if ($admin && Hash::check($request->password, $admin->password)) {
                session([
                    'admin_logged_in' => true,
                    'admin_id' => $admin->id,
                    'admin_name' => $admin->name,
                ]);
                return redirect()->route('admin.dashboard');
            }

            return back()->withErrors(['login' => 'Invalid admin credentials'])->withInput();
        }

        if ($request->role === 'member') {
            // 👤 Member login (no status check)
            $user = User::where('email', $request->email)->first();

            if ($user && Hash::check($request->password, $user->password)) {
                Auth::login($user);
                session(['member_logged_in' => true]);
                return redirect('/profile');
            }

            return back()->withErrors(['login' => 'Invalid member credentials'])->withInput();
        }

        return back()->withErrors(['login' => 'Invalid login attempt'])->withInput();
    }

    // ✅ Logout
    public function logout(Request $request)
    {
        Auth::logout(); // for member
        $request->session()->flush(); // clear all session data
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
