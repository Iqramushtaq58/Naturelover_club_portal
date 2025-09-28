<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    // Show events page
    public function index()
    {
        $events = Event::all();
        $joinedEventIds = auth()->check()
            ? auth()->user()->events->pluck('id')->toArray()
            : [];

        return view('events', compact('events', 'joinedEventIds'));
    }

    // Join an event
    public function join($id)
    {
        $user = Auth::user();
        $event = Event::findOrFail($id);

        // Prevent duplicate entries
        $user->events()->syncWithoutDetaching($event->id);

        return redirect()->back()->with('success', 'You have successfully joined the event!');
    }
}
