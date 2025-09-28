<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    // ✅ Show Profile Page
    public function show()
    {
        $user = Auth::user();
        return view('profile', compact('user'));
    }

    // ✅ Update Profile
    public function update(Request $request)
    {
        $user = Auth::user();

        // ✅ Validate input fields
        $request->validate([
            'name'            => 'required|string|max:255',
            'father_name'     => 'required|string|max:255',
            'student_id'      => 'required|string|max:255',
            'department'      => 'required|string|max:255',
            'cnic'            => 'required|string|max:25',
            'phone'           => 'required|string|max:25',
            'gender'          => 'required|in:Male,Female',
            'profile_picture' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // ✅ Handle profile picture upload
        if ($request->hasFile('profile_picture')) {
            // Delete old picture if exists
            if ($user->profile_picture && file_exists(public_path('uploads/' . $user->profile_picture))) {
                unlink(public_path('uploads/' . $user->profile_picture));
            }

            // Save new picture in 'uploads/' directory directly
            $file = $request->file('profile_picture');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads'), $filename);
            $user->profile_picture = $filename;
        }

        // ✅ Update other profile fields
        $user->name         = $request->name;
        $user->father_name  = $request->father_name;
        $user->student_id   = $request->student_id;
        $user->department   = $request->department;
        $user->cnic         = $request->cnic;
        $user->phone        = $request->phone;
        $user->gender       = $request->gender;

        $user->save();

        return redirect()->route('profile.show')->with('success', 'Profile updated successfully!');
    }
}
