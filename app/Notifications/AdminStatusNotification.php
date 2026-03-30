<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class AdminStatusNotification extends Notification
{
    use Queueable;

    public function __construct(public string $status) {}

    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toArray(object $notifiable): array
    {
        $message = $this->status === 'approved'
            ? 'Your admin account has been approved! You can now log in and access the admin dashboard.'
            : 'Your admin account registration has been rejected. Please contact support for more information.';

        return [
            'type'    => 'admin_status',
            'status'  => $this->status,
            'message' => $message,
        ];
    }
}
