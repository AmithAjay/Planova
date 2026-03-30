<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RegistrationController extends Controller
{
    public function index()
    {
        $events = auth()->user()->registeredEvents()->paginate(12);
        return view('events.my_events', compact('events'));
    }

    public function showRegistrationForm(\App\Models\Event $event)
    {
        if ($event->participants()->where('user_id', auth()->id())->exists()) {
            return redirect()->route('events.show', $event)->with('error', 'You are already registered for this event.');
        }

        return view('events.register_event', compact('event'));
    }

    public function store(Request $request, \App\Models\Event $event)
    {
        if ($event->approval_status !== 'approved') {
            abort(403, 'Cannot register for unapproved events.');
        }

        if ($event->participants()->where('user_id', auth()->id())->exists()) {
            return back()->with('error', 'Already registered.');
        }

        if ($event->max_participants && $event->participants()->count() >= $event->max_participants) {
            return back()->with('error', 'Event is full.');
        }

        $validated = $request->validate([
            'gender' => 'required|in:Male,Female,Other,Prefer not to say',
            'phone_number' => ['required', 'regex:/^(\+91[\-\s]?)?[0]?(91)?[789]\d{9}$/'], // Indian phone regex
            'responses' => 'nullable|array',
        ]);

        $event->participants()->attach(auth()->id(), [
            'status' => 'registered',
            'gender' => $validated['gender'],
            'phone_number' => $validated['phone_number'],
            'responses' => json_encode($validated['responses'] ?? []),
        ]);

        return redirect()->route('events.show', $event)->with('success', 'Registration protocol completed. Welcome to ' . $event->title);
    }

    public function adminIndex()
    {
        $search = request('search');
        $gender = request('gender');

        $registrations = \App\Models\Registration::with(['user', 'event'])
            ->when($search, function ($query) use ($search) {
            $query->whereHas('user', function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%");
                }
                );
            })
            ->when($gender, function ($query) use ($gender) {
            $query->where('gender', $gender);
        })
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('admin.registrations', compact('registrations'));
    }

    public function export()
    {
        return \Maatwebsite\Excel\Facades\Excel::download(new \App\Exports\RegistrationsExport, 'registrations_' . now()->format('Y-m-d') . '.xlsx');
    }

    public function destroy(\App\Models\Event $event)
    {
        $event->participants()->detach(auth()->id());

        return back()->with('success', 'Registration cancelled.');
    }
}
