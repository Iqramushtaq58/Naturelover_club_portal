<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Models\User;

class UserController extends Controller
{
    public function loginUser(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $credentials = $request->only('email', 'password');

        // Check if user exists
        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return redirect('/register')->with('error', 'You are not registered. Please register first.');
        }

        // Attempt to log in
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('user.profile')->with('success', 'Login successful!');
        }

        return redirect('/')->with('error', 'Invalid credentials. Please try again.');
    }

    /**
     * Show the profile page of the authenticated user.
     */

public function showProfile()
{
    $user = auth()->user();  // <- this line gets the logged-in user
    return view('profile', compact('user'));  // <- this sends $user to the view
}

    /**
     * Update the profile of the authenticated user.
     */
    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name'           => 'required|string|max:255',
            'father_name'    => 'required|string|max:255',
            'student_id'     => 'required|string|max:50',
            'department'     => 'required|string|max:100',
            'email'          => 'required|email|unique:users,email,' . $user->id,
            'cnic'           => 'required|string|max:15',
            'phone'          => 'required|string|max:15',
            'gender'         => 'required|in:Male,Female',
            'profile_picture'=> 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Handle profile picture upload
        if ($request->hasFile('profile_picture')) {
            if ($user->profile_picture) {
                Storage::delete('public/profile_pictures/' . $user->profile_picture);
            }

            $image = $request->file('profile_picture');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->storeAs('public/profile_pictures', $imageName);
            $user->profile_picture = $imageName;
        }

        // Update user data
        $user->update($request->only([
            'name', 'father_name', 'student_id', 'department',
            'email', 'cnic', 'phone', 'gender'
        ]));

        return back()->with('success', 'Profile updated successfully.');
    }

    /**
     * Log the user out and invalidate the session.
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/')->with('success', 'You have been logged out.');
    }
}
