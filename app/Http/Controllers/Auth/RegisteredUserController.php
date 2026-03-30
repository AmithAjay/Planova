<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        $departments = \App\Models\Department::all();
        return view('auth.register', compact('departments'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name'          => ['required', 'string', 'max:255'],
            'email'         => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password'      => ['required', 'confirmed', Rules\Password::defaults()],
            'role'          => ['required', 'string', 'in:student,admin'],
            'department_id' => ['required', 'exists:departments,id'],
        ]);

        // Admins start as 'pending' until super admin approves.
        // Students are approved immediately.
        $status = $request->role === 'admin' ? 'pending' : 'approved';

        $user = User::create([
            'name'          => $request->name,
            'email'         => $request->email,
            'password'      => Hash::make($request->password),
            'role'          => $request->role,
            'status'        => $status,
            'department_id' => $request->department_id,
        ]);

        event(new Registered($user));

        if ($request->role === 'admin') {
            // Notify all super admins about the pending admin request
            $superAdmins = User::where('role', 'super_admin')->get();
            foreach ($superAdmins as $superAdmin) {
                $superAdmin->notify(new \App\Notifications\AdminApprovalRequestNotification($user));
            }

            // Don't log them in — send to a waiting page
            return redirect()->route('admin.pending')
                ->with('pending_email', $user->email);
        }

        // Students log in immediately
        Auth::login($user);
        return redirect(route('dashboard', absolute: false));
    }
}

