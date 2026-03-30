<?php

namespace App\Notifications;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class AdminApprovalRequestNotification extends Notification
{
    use Queueable;

    public function __construct(public User $applicant) {}

    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toArray(object $notifiable): array
    {
        return [
            'type'    => 'admin_approval_request',
            'message' => "New admin registration request from {$this->applicant->name} ({$this->applicant->email}).",
            'user_id' => $this->applicant->id,
            'url'     => url('/admin#pending-admins'),
        ];
    }
}
