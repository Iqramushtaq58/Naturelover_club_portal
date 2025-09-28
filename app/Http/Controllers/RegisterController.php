<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class RegisterController extends Controller
{
    // Show registration form
    public function showRegister()
    {
        return view('register');
    }

    // Handle registration
    public function register(Request $request)
    {
        // Validation
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'father_name' => 'required|string|max:255',
            'student_id' => 'required|string|max:50|unique:users,student_id',
            'department' => 'required|string',
            'cnic' => 'required|string|max:15|unique:users,cnic',
            'phone' => 'required|string|max:15',
            'gender' => 'required|in:Male,Female',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed|min:6',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Handle file upload
        $profilePicturePath = null;
        if ($request->hasFile('profile_picture')) {
            $profilePicturePath = $request->file('profile_picture')->store('profiles', 'public');
        }

        // Create user
        $user = new User();
        $user->name = $request->name;
        $user->father_name = $request->father_name;
        $user->student_id = $request->student_id;
        $user->department = $request->department;
        $user->cnic = $request->cnic;
        $user->phone = $request->phone;
        $user->gender = $request->gender;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->profile_picture = $profilePicturePath;
        $user->save();

        return redirect()->route('login')->with('success', 'Registration successful! You can now login.');
    }
}
