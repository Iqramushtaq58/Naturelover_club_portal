<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Show the registration form
    public function showRegister()
    {
        if (auth()->check()) {
            return redirect()->route('user.profile'); // Redirect if already logged in
        }
        return view('register');
    }

    // Register a new user
    public function registerUser(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
            'profile_picture' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $imagePath = null;

        if ($request->hasFile('profile_picture')) {
            $imagePath = $request->file('profile_picture')->store('profile_pictures', 'public');
        }

        $user = new User();
        $user->name     = $request->name;
        $user->email    = $request->email;
        $user->password = Hash::make($request->password);
        $user->profile_picture = $imagePath;
        $user->save();

        return redirect()->route('login')->with('success', 'Registration successful! Please log in.');
    }

    // Show the login form
    public function showLogin()
    {
        if (auth()->check()) {
            return redirect()->route('user.profile'); // Redirect if already logged in
        }
        return view('login');
    }

    // Log out the user
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Logged out successfully.');
    }
}
