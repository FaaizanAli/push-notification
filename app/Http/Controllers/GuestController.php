<?php

// app/Http/Controllers/GuestController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Guest;
use Minishlink\WebPush\Subscription;
use Minishlink\WebPush\WebPush;

class GuestController extends Controller
{
//    public function store(Request $request)
//    {
//        $validatedData = $request->validate([
//            'endpoint' => 'required|string',
//            'keys.p256dh' => 'required|string',
//            'keys.auth' => 'required|string',
//        ]);
//
//        $guest = Guest::create([
//            'notification_allowed' => true,
//            'endpoint' => $validatedData['endpoint'],
//            'public_key' => $validatedData['keys']['p256dh'],
//            'auth_token' => $validatedData['keys']['auth'],
//        ]);
//
//        return response()->json(['guestId' => $guest->id], 201);
//    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'endpoint' => 'required|string',
            'keys.p256dh' => 'required|string',
            'keys.auth' => 'required|string',
        ]);

        // Check if the guest record already exists
        $existingGuest = Guest::where('endpoint', $validatedData['endpoint'])
            ->where('public_key', $validatedData['keys']['p256dh'])
            ->where('auth_token', $validatedData['keys']['auth'])
            ->first();

        if ($existingGuest) {
            // Return the existing guest ID if the record already exists
            return response()->json(['guestId' => $existingGuest->id], 200);
        }

        // Create a new guest record if it doesn't exist
        $guest = Guest::create([
            'notification_allowed' => true,
            'endpoint' => $validatedData['endpoint'],
            'public_key' => $validatedData['keys']['p256dh'],
            'auth_token' => $validatedData['keys']['auth'],
        ]);

        return response()->json(['guestId' => $guest->id], 201);
    }


    public function sendNotification($guestId)
    {
        $guest = Guest::find($guestId);


        if (!$guest || !$guest->endpoint) {
            return response()->json(['error' => 'Invalid subscription data'], 400);
        }


        $subscription = Subscription::create([
            'endpoint' => $guest->endpoint,
            'keys' => [
                'p256dh' => $guest->public_key,
                'auth' => $guest->auth_token,
            ],
        ]);


        $webPush = new WebPush([
            'VAPID' => [
                'subject' => 'mailto: <youremail@gmail.com>',
                'publicKey' => env('VAPID_PUBLIC_KEY'),
                'privateKey' => env('VAPID_PRIVATE_KEY'),
            ],
        ]);


        $notification = [
            'title' => 'Hello!',
            'body' => 'This is a test notification.',
        ];


        $webPush->sendOneNotification($subscription, json_encode($notification));
    }
}
