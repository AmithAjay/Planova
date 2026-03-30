<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\NotificationController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\DashboardController::class , 'index'])->name('dashboard');

    Route::resource('events', \App\Http\Controllers\EventController::class);
    Route::post('/events/{event}/duplicate', [\App\Http\Controllers\EventController::class , 'duplicate'])->name('events.duplicate');

    Route::get('/events/{event}/register', [\App\Http\Controllers\RegistrationController::class , 'showRegistrationForm'])->name('events.register.form');
    Route::post('/events/{event}/register', [\App\Http\Controllers\RegistrationController::class , 'store'])->name('events.register');
    Route::delete('/events/{event}/cancel', [\App\Http\Controllers\RegistrationController::class , 'destroy'])->name('events.cancel');
    Route::get('/my-events', [\App\Http\Controllers\RegistrationController::class , 'index'])->name('events.my');

    Route::post('/notifications/mark-read', [NotificationController::class , 'markAllRead'])->name('notifications.markAllRead');

    Route::middleware(['role:admin,super_admin'])->group(function () {
            Route::get('/admin', [\App\Http\Controllers\AdminController::class, 'index'])->name('admin.dashboard');
            Route::get('/admin/registrations', [\App\Http\Controllers\RegistrationController::class, 'adminIndex'])->name('admin.registrations');
            Route::get('/admin/registrations/export', [\App\Http\Controllers\RegistrationController::class, 'export'])->name('admin.registrations.export');
            Route::get('/admin/guidelines', [\App\Http\Controllers\AdminController::class, 'guidelines'])->name('admin.guidelines');
            Route::post('/admin/events/{event}/approve', [\App\Http\Controllers\AdminController::class, 'approve'])->name('admin.events.approve');
            Route::post('/admin/events/{event}/reject', [\App\Http\Controllers\AdminController::class, 'reject'])->name('admin.events.reject');
        }
        );

        Route::get('/event-banner/{event}', function(\App\Models\Event $event) {
            if (!$event->image_path) abort(404);
            $path = storage_path('app/public/' . $event->image_path);
            if (!file_exists($path)) abort(404);
            return response()->file($path);
        })->name('event.banner');

        // Super admin only: user management
        Route::middleware(['role:super_admin'])->group(function () {
            Route::post('/admin/users/{user}/approve', [\App\Http\Controllers\AdminController::class, 'approveAdmin'])->name('admin.users.approve');
            Route::post('/admin/users/{user}/reject', [\App\Http\Controllers\AdminController::class, 'rejectAdmin'])->name('admin.users.reject');
            Route::patch('/admin/users/{user}/toggle-status', [\App\Http\Controllers\AdminController::class, 'toggleUserStatus'])->name('admin.users.toggle');
            Route::delete('/admin/users/{user}', [\App\Http\Controllers\AdminController::class, 'deleteUser'])->name('admin.users.delete');
        });

        Route::get('/profile', [ProfileController::class , 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class , 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class , 'destroy'])->name('profile.destroy');
    });

// Custom Password Reset Routes
Route::post('/custom-forgot-password', [\App\Http\Controllers\PasswordResetController::class, 'sendResetLinkEmail'])->name('custom.password.email');
Route::get('/custom-reset-password/{token}', [\App\Http\Controllers\PasswordResetController::class, 'showResetForm'])->name('custom.password.reset');
Route::post('/custom-reset-password', [\App\Http\Controllers\PasswordResetController::class, 'reset'])->name('custom.password.update');

// Shown to newly registered admins while they await super admin approval
Route::get('/admin-pending-approval', function () {
    return view('auth.admin_pending');
})->name('admin.pending');

require __DIR__ . '/auth.php';
