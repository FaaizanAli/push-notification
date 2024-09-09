<?php

namespace App\Helpers;

use App\Notifications\ParentNotification;
use App\Notifications\PostPublishNotification;

class NotificationHelper
{
    /**
     * Send notifications to users.
     *
     * @param string $title
     * @param string $message
     * @param string $notificationType
     * @param \Illuminate\Support\Collection|array $sendToUsers
     * @param string $userId
     * @param \Illuminate\Support\Collection|array $sendToUsers
     */
    public static function sendNotification($title, $message, $notificationType, $sendToUsers, $userId)
    {
        foreach ($sendToUsers as $sendToUser) {
            try {
                $sendToUser->notify(new ParentNotification(
                    title: $title,
                    message: $message,
                    notificationType: $notificationType,
                    userId: $userId
                ));
            } catch (\Exception $e) {
                // Log the error or handle it accordingly
//                \Log::error("Failed to send notification to user ID {$sendToUser->id}: " . $e->getMessage());
            }
        }
    }

    public static function postNotification($title, $message, $postId, $notificationType, $sendToUsers,$userId)
    {
        foreach ($sendToUsers as $sendToUser) {
            try {
                $sendToUser->notify(new PostPublishNotification(
                    title: $title,
                    message: $message,
                    postId: $postId,
                    notificationType: $notificationType,
                    userId: $userId

                ));
            } catch (\Exception $e) {
                // Log the error or handle it accordingly
//                \Log::error("Failed to send notification to user ID {$sendToUser->id}: " . $e->getMessage());
            }
        }
    }
}
