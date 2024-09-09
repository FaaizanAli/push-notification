<?php

namespace App\Notifications;

use App\Models\Announcement;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AnnouncementNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(

        private readonly string $title,
        private readonly string $message,
        protected User $user,
        private readonly ?string $imageUrl = null

    )
    {
        //
    }


    public function via(object $notifiable): string
    {
        return FirebaseChannel::class;
    }
    public function getData(): array
    {
        return [
            'type' => 'notification',
        ];
    }

    public function toFirebase($notifiable): array
    {
        return [
            'body' => $this->message,
            'title' => $this->title,
            'imageUrl' => $this->imageUrl,
        ];
    }
}
