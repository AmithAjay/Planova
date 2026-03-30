<?php

namespace App\Policies;

use App\Models\Event;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class EventPolicy
{
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, Event $event): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        // Students can create if they have permission via role, or we can allow anyone and just set to pending.
        // Let's allow everyone, but students' events will go to pending approval.
        return true;
    }

    public function update(User $user, Event $event): bool
    {
        return $user->isAdmin() || $user->id === $event->created_by;
    }

    public function delete(User $user, Event $event): bool
    {
        return $user->isAdmin() || $user->id === $event->created_by;
    }

    public function approve(User $user, Event $event): bool
    {
        return $user->isAdmin();
    }
}
