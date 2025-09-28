<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Models\Admin;
use App\Models\User;
use App\Models\Event;
use App\Models\EventUser;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    // 🧠 Dashboard
    public function dashboard()
    {
        $totalMembers = User::count();
        $totalEvents = Event::count();
        $joinedEvents = DB::table('event_user')->count();

        return view('admin.dashboard', compact('totalMembers', 'totalEvents', 'joinedEvents'));
    }

    // 🚪 Admin Logout
    public function logout()
    {
        Session::flush();
        return redirect()->route('login')->with('success', 'Logged out successfully.');
    }

    // 👥 View & Search Members
    public function members(Request $request)
    {
        $search = $request->query('search');

        $members = User::when($search, function ($query, $search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'LIKE', $search . '%')    // matches start of name
                  ->orWhere('email', 'LIKE', $search . '%') // matches start of email
                  ->orWhere('phone', 'LIKE', $search . '%'); // optional
            });
        })->paginate(10);

        return view('admin.members', compact('members'));
    }

    // ❌ Delete Member
    public function deleteMember($id)
    {
        $member = User::findOrFail($id);

        // Delete image file if exists
        if ($member->profile_pic && file_exists(public_path('uploads/' . $member->profile_pic))) {
            unlink(public_path('uploads/' . $member->profile_pic));
        }

        $member->delete();
        return back()->with('success', 'Member deleted successfully.');
    }

    // 📅 List/Search Events
    public function events(Request $request)
    {
        $search = $request->query('search');
        $events = Event::when($search, function ($query, $search) {
            return $query->where('title', 'like', "%$search%")
                         ->orWhere('description', 'like', "%$search%");
        })->orderBy('event_date', 'desc')->paginate(10);

        return view('admin.events', compact('events'));
    }

    // ➕ Create Event
    public function storeEvent(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'event_date' => 'required|date',
            'image' => 'nullable|image|max:2048'
        ]);

        $event = new Event();
        $event->title = $request->title;
        $event->description = $request->description;
        $event->event_date = $request->event_date;

        if ($request->hasFile('image')) {
            $filename = time() . '.' . $request->image->extension();
            $request->image->move(public_path('uploads/events'), $filename);
            $event->image = 'events/' . $filename;
        }

        $event->save();
        return back()->with('success', 'Event created successfully.');
    }

    // ✏️ Edit Event Page
    public function editEvent($id)
    {
        $event = Event::findOrFail($id);
        return view('admin.edit_event', compact('event'));
    }

    // 🔄 Update Event
    public function updateEvent(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'event_date' => 'required|date',
            'image' => 'nullable|image|max:2048'
        ]);

        $event = Event::findOrFail($id);
        $event->title = $request->title;
        $event->description = $request->description;
        $event->event_date = $request->event_date;

        if ($request->hasFile('image')) {
            // Delete old image
            if ($event->image && file_exists(public_path('uploads/' . $event->image))) {
                unlink(public_path('uploads/' . $event->image));
            }

            // Save new image
            $filename = time() . '.' . $request->image->extension();
            $request->image->move(public_path('uploads/events'), $filename);
            $event->image = 'events/' . $filename;
        }

        $event->save();
        return redirect()->route('admin.events')->with('success', 'Event updated successfully.');
    }

    // ❌ Delete Event
    public function deleteEvent($id)
    {
        $event = Event::findOrFail($id);

        if ($event->image && file_exists(public_path('uploads/' . $event->image))) {
            unlink(public_path('uploads/' . $event->image));
        }

        $event->delete();
        return back()->with('success', 'Event deleted successfully.');
    }

    // 👁️ View Which Members Joined Each Event
    public function viewEventMembers()
    {
        $events = Event::with('users')->get();
        return view('admin.event_members', compact('events'));
    }
}
