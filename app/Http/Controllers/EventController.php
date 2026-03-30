<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Http\Requests\StoreEventRequest;
use App\Http\Requests\UpdateEventRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request; // Added this use statement
use Illuminate\Support\Facades\Storage; // Added this use statement
use App\Models\User; // Added this use statement
use App\Notifications\NewRegistrationNotification; // Added this use statement
use App\Notifications\NewEventNotification; // Added this use statement

class EventController extends Controller
{
    public function index()
    {
        $search = request('search');
        $categoryId = request('category_id');

        $query = Event::with(['category', 'creator'])
            ->orderBy('date', 'asc');

        if (auth()->user()->isStudent()) {
            $query->where('approval_status', 'approved');

            $studentDepartment = auth()->user()->department->name ?? '';
            $query->where(function ($q) use ($studentDepartment) {
                $q->where('is_open_to_all', true)
                    ->orWhereJsonContains('eligible_departments', $studentDepartment);
            });
        }

        $query->when($search, function ($q) use ($search) {
            $q->where(function ($sq) use ($search) {
                    $sq->where('title', 'like', '%' . $search . '%')
                        ->orWhere('description', 'like', '%' . $search . '%')
                        ->orWhere('location', 'like', '%' . $search . '%');
                }
                );
            });

        $query->when($categoryId, function ($q) use ($categoryId) {
            $q->where('category_id', $categoryId);
        });

        $events = $query->paginate(12)->withQueryString();
        $categories = \App\Models\Category::all();

        return view('events.index', compact('events', 'categories'));
    }

    public function create()
    {
        $categories = \App\Models\Category::all();
        $departments = \App\Models\Department::all();

        $faculty = User::whereIn('role', ['admin', 'super_admin'])->with('department')->get();
        $students = User::where('role', 'student')->with('department')->get();

        return view('events.create', compact('categories', 'departments', 'faculty', 'students'));
    }

    public function store(StoreEventRequest $request)
    {
        $validated = $request->validated();
        $validated['created_by'] = auth()->id();
        $validated['approval_status'] = auth()->user()->isStudent() ? 'pending' : 'approved';

        if (isset($validated['custom_fields'])) {
            $validated['custom_fields'] = json_decode($validated['custom_fields'], true);
        }

        $event = Event::create($validated);

        if ($request->hasFile('image')) {
            $event->image_path = $request->file('image')->store('events/images', 'public');
        }

        if ($request->hasFile('video')) {
            $event->video_path = $request->file('video')->store('events/videos', 'public');
        }
        
        $event->save();

        // Sync Organizing Team
        $this->syncOrganizingTeam($event, $request);

        // Notify eligible students when event is approved (admin-created events are auto-approved)
        if ($event->approval_status === 'approved') {
            $studentQuery = User::where('role', 'student');

            // If event is NOT open to all, filter by eligible departments
            if (!$event->is_open_to_all && !empty($event->eligible_departments)) {
                $studentQuery->whereHas('department', function ($q) use ($event) {
                    $q->whereIn('name', $event->eligible_departments);
                });
            }

            $students = $studentQuery->get();
            foreach ($students as $student) {
                $student->notify(new NewEventNotification($event));
            }
        }

        return redirect()->route('events.show', $event)->with('success', 'Event created successfully.');
    }

    public function show(Event $event)
    {
        if ($event->approval_status !== 'approved' && !auth()->user()->isAdmin() && auth()->id() !== $event->created_by) {
            abort(403);
        }

        $event->load(['category', 'creator', 'participants']);

        return view('events.show', compact('event'));
    }

    public function edit(Event $event)
    {
        Gate::authorize('update', $event);
        $categories = \App\Models\Category::all();
        $departments = \App\Models\Department::all();

        $faculty = User::whereIn('role', ['admin', 'super_admin'])->with('department')->get();
        $students = User::where('role', 'student')->with('department')->get();

        $event->load('team');

        return view('events.edit', compact('event', 'categories', 'departments', 'faculty', 'students'));
    }

    public function update(UpdateEventRequest $request, Event $event)
    {
        Gate::authorize('update', $event);
        \Log::info('Update Request Data:', $request->all());
        $validated = $request->validated();
        \Log::info('Validated Data:', $validated);

        if (isset($validated['custom_fields'])) {
            $validated['custom_fields'] = json_decode($validated['custom_fields'], true);
        }

        $validated['is_published'] = $request->has('is_published');

        $event->update($validated);

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($event->image_path) {
                Storage::disk('public')->delete($event->image_path);
            }
            $event->image_path = $request->file('image')->store('events/images', 'public');
        }

        if ($request->hasFile('video')) {
            // Delete old video if exists
            if ($event->video_path) {
                Storage::disk('public')->delete($event->video_path);
            }
            $event->video_path = $request->file('video')->store('events/videos', 'public');
        }

        $event->save();

        // Sync Organizing Team
        $this->syncOrganizingTeam($event, $request);

        return redirect()->route('events.show', $event)->with('success', 'Event updated successfully.');
    }

    private function syncOrganizingTeam(Event $event, Request $request)
    {
        $team = [];

        if ($request->head_faculty_id) {
            $team[$request->head_faculty_id] = ['role' => 'head_faculty'];
        }

        if ($request->staff_ids) {
            foreach ($request->staff_ids as $id) {
                if ($id && !isset($team[$id])) {
                    $team[$id] = ['role' => 'staff'];
                }
            }
        }

        if ($request->volunteer_ids) {
            foreach ($request->volunteer_ids as $id) {
                if ($id && !isset($team[$id])) {
                    $team[$id] = ['role' => 'volunteer'];
                }
            }
        }

        $event->team()->sync($team);
    }

    // Assuming this is a new method for registration, or an existing one being modified.
    // The provided snippet implies a method that handles registration.
    public function register(Request $request, Event $event)
    {
        // Ensure user is authenticated
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'Please log in to register for an event.');
        }

        // Prevent multiple registrations by the same user for the same event
        if ($event->participants()->where('user_id', auth()->id())->exists()) {
            return back()->with('error', 'You have already registered for this event.');
        }

        // Collect all details from the request
        $responses = $request->except(['_token', 'gender', 'phone_number']);

        $registration = \App\Models\Registration::create([
            'user_id' => auth()->id(),
            'event_id' => $event->id,
            'status' => 'registered',
            'gender' => $request->gender,
            'phone_number' => $request->phone_number,
            'responses' => $responses
        ]);

        // Send notification to Admins
        $admins = User::where('role', 'admin')->get();
        foreach ($admins as $admin) {
            $admin->notify(new NewRegistrationNotification($event, auth()->user()));
        }

        return redirect()->route('events.show', $event)->with('success', 'Successfully registered for the event!');
    }

    public function duplicate(Event $event)
    {
        Gate::authorize('update', $event);

        $newEvent = $event->replicate();
        $newEvent->title = $newEvent->title . ' (Copy)';
        $newEvent->approval_status = 'pending';
        // For duplication, we don't copy the image_path or video_path to avoid confusion or we can keep it if desired. 
        // User didn't specify so I'll null them for a fresh start.
        $newEvent->image_path = null;
        $newEvent->video_path = null;
        $newEvent->save();

        return redirect()->route('events.edit', $newEvent)->with('success', 'Event duplicated. Please update the details.');
    }

    public function destroy(Event $event)
    {
        Gate::authorize('delete', $event);
        $event->delete();

        return redirect()->route('events.index')->with('success', 'Event deleted successfully.');
    }
}
