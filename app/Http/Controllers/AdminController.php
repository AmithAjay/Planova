<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $stats = [
            'total_users'          => \App\Models\User::count(),
            'total_events'         => \App\Models\Event::count(),
            'pending_events'       => \App\Models\Event::where('approval_status', 'pending')->count(),
            'total_registrations'  => \App\Models\Registration::count(),
            'pending_admins'       => \App\Models\User::where('role', 'admin')->where('status', 'pending')->count(),
        ];

        $eventsForChart = \App\Models\Event::withCount('registrations')
            ->orderBy('registrations_count', 'desc')
            ->take(10)
            ->get();

        $chartData = [
            'labels' => $eventsForChart->pluck('title'),
            'values' => $eventsForChart->pluck('registrations_count'),
        ];

        $pendingEvents = \App\Models\Event::where('approval_status', 'pending')->with('creator')->get();

        $pendingAdmins = \App\Models\User::where('role', 'admin')
            ->where('status', 'pending')
            ->with('department')
            ->latest()
            ->get();

        $allUsersQuery = \App\Models\User::with('department')->latest();

        if ($search) {
            $allUsersQuery->where(function($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%")
                  ->orWhere('email', 'LIKE', "%{$search}%");
            });
        }

        $allUsers = $allUsersQuery->paginate(10)->withQueryString();

        return view('admin.dashboard', compact('stats', 'chartData', 'pendingEvents', 'pendingAdmins', 'allUsers', 'search'));
    }

    public function guidelines()
    {
        return view('admin.guidelines');
    }

    public function approve(\App\Models\Event $event)
    {
        $event->update(['approval_status' => 'approved']);
        return back()->with('success', 'Event approved successfully.');
    }

    public function reject(\App\Models\Event $event)
    {
        $event->update(['approval_status' => 'rejected']);
        return back()->with('success', 'Event rejected successfully.');
    }

    /**
     * Approve a pending admin account.
     */
    public function approveAdmin(User $user)
    {
        $user->update(['status' => 'approved']);
        $user->notify(new \App\Notifications\AdminStatusNotification('approved'));
        return back()->with('success', "Admin account for {$user->name} has been approved.");
    }

    /**
     * Reject a pending admin account.
     */
    public function rejectAdmin(User $user)
    {
        $user->update(['status' => 'rejected']);
        $user->notify(new \App\Notifications\AdminStatusNotification('rejected'));
        return back()->with('success', "Admin account for {$user->name} has been rejected.");
    }

    /**
     * Toggle User Clearance Status (Student <-> Admin)
     */
    public function toggleUserStatus(User $user)
    {
        if ($user->role === 'super_admin') {
            return back()->with('error', 'Cannot alter Super Admin clearance.');
        }

        if ($user->role === 'admin') {
            $user->update(['role' => 'student']);
            return back()->with('success', "Revoked Admin clearance for {$user->name}.");
        } else {
            $user->update(['role' => 'admin', 'status' => 'approved']);
            return back()->with('success', "Granted Admin clearance to {$user->name}.");
        }
    }

    /**
     * Permanently Delete User
     */
    public function deleteUser(User $user)
    {
        if ($user->role === 'super_admin') {
            return back()->with('error', 'Critical System Override: Cannot delete Super Admin.');
        }

        $userName = $user->name;
        $user->delete();

        return back()->with('success', "Target {$userName} has been removed from the system.");
    }
}

