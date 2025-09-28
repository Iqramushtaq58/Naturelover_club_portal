<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Event;

class PageController extends Controller
{
    // Home Page
    public function home()
    {
        return view('home');
    }

    // About Page
    public function about()
    {
        return view('about');
    }

    // Contact Page
    public function contact()
    {
        return view('contact');
    }

    // Handle Contact Form Submission
    public function submitContact(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required',
        ]);

        return back()->with('success', 'Your message has been sent!');
    }

    // Events Page
    public function events()
    {
        $events = Event::all();

        $joinedEventIds = [];
        if (Auth::check()) {
            $joinedEventIds = Auth::user()->joinedEvents()->pluck('event_id')->toArray();
        }

        return view('events', compact('events', 'joinedEventIds'));
    }
}
