<?php

namespace App\Notifications;

use App\Helpers\TranslateHelper;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notification;
use Kreait\Firebase\Contract\Messaging;
use Kreait\Firebase\Exception\FirebaseException;
use Kreait\Firebase\Exception\MessagingException;
use Kreait\Firebase\Exception\RuntimeException;
use Kreait\Firebase\Factory;
use Kreait\Firebase\Messaging\CloudMessage;

class FirebaseChannel
{
    public Messaging $messaging;

    public function __construct()
    {
        $this->messaging = $this->connect();
    }

    /**
     * Send the given notification.
     * @throws MessagingException
     * @throws FirebaseException
     */
    public function send(Model $notifiable, Notification $notification): void
    {

        $message = $notification->toFirebase($notifiable);




        if (method_exists($notification, 'getData')) {
            $data = $notification->getData();
        }
        /** @var User $notifiable */
        $deviceToken = $notifiable->fcm_token;




        if (!isset($deviceToken)) {
            throw new RuntimeException('fcm_token not set for this user: ' . $notifiable->name);
        }
        $this->messaging->send(
            CloudMessage::withTarget('token', $deviceToken)
                ->withData($data ?? [])
                ->withNotification($message)
        );
//        try {
//            // Check if the device token is set
//            if (!isset($deviceToken)) {
//                throw new RuntimeException('fcm_token not set for this user: ' . $notifiable->name);
//            }
//
//            // Send the notification
//            $this->messaging->send(
//                CloudMessage::withTarget('token', $deviceToken)
//                    ->withData($data ?? [])
//                    ->withNotification($message)
//            );
//
//            // If no exception is thrown, the notification was sent successfully
//            dd('Notification sent successfully to user: ' . $notifiable->name);
//
//        } catch (\Kreait\Firebase\Exception\MessagingException $e) {
//            // Handle the exception if the notification fails
//            dd('Failed to send notification: ' . $e->getMessage());
//        } catch (\Exception $e) {
//            // Handle any other exceptions
//            dd('An error occurred: ' . $e->getMessage());
//        }



    }

    public function connect(): Messaging
    {
        $firebase = (new Factory)->withServiceAccount(base_path(config('services.firebase.credentials')));
        return $firebase->createMessaging();
    }
}
