<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Registration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class DashboardController extends Controller
{
    /**
     * Display the student dashboard.
     */
    public function index()
    {
        $user = Auth::user();

        // 1. Count upcoming events (events scheduled for today or in the future)
        // We assume 'date' column is a date or datetime
        $upcomingEventsCount = Event::where('date', '>=', Carbon::today())
            ->where('approval_status', 'approved') // Assuming only approved events should be counted
            ->count();

        // 2. Count registrations for the current user
        $userRegistrationsCount = Registration::where('user_id', $user->id)->count();

        return view('dashboard', compact('upcomingEventsCount', 'userRegistrationsCount'));
    }
}
