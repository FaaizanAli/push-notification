<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use App\Models\AvailabilityOfUser;
use App\Models\Finance;
use App\Models\FinanceAdmin;
use App\Models\Grade;
use App\Models\Guest;
use App\Models\User;
use App\Services\ImageService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Minishlink\WebPush\Subscription;
use Minishlink\WebPush\WebPush;

class DashboardController extends Controller
{
    public function Dashboard()
    {
        $users = User::query()->where('role', 'client')->get();

        return view('backend.admin.dashboard',compact('users'));
    }

    public function SendNotification(Request $request)
    {
        try {

            if($request->hasFile('image')){
                $img = ImageService::addImage('images/notification',$request->file('image'), 'notification_');

                $imgUrl = $img ? asset('images/notification/'.$img) : null;
            }else{
                $imgUrl = null;
            }


            if($request->type == 'android_user'){
                $users = User::query()->where('role','client')
                    ->whereNotNull('fcm_token')
                    ->where('device_type','android')
                    ->get();

                $this->sendNotifications($request,$imgUrl,$users);
            }
            if($request->type == 'ios_user'){
                $users = User::query()->where('role','client')
                    ->whereNotNull('fcm_token')
                    ->where('device_type','ios')
                    ->get();
                $this->sendNotifications($request,$imgUrl,$users);
            }

            if($request->type == 'web_user'){
                $users = Guest::all();
                $this->sendNotificationToGuest($users, $request,$imgUrl);
            }

            if($request->type == 'all'){
                $users = User::query()->where('role','client')
                    ->whereNotNull('fcm_token')
                    ->whereIn('device_type', ['ios', 'android'])
                    ->get();
                $this->sendNotifications($request,$imgUrl,$users);

                $GuestUsers = Guest::all();
                $this->sendNotificationToGuest($GuestUsers, $request,$imgUrl);
            }




            $notification = array(
                'message' => 'Notification sent successfully!',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);


        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }

    }
    public function sendNotifications($request,$imgUrl,$users)
    {

        foreach ($users as $user) {
            $this->sendNotificationToUser($user, $request->title, $request->body,$imgUrl);
        }
    }
    private function sendNotificationToUser($user, $title, $message,$imgUrl)
    {
        try {
            $user->notify(new \App\Notifications\AnnouncementNotification(
                title: $title,
                message: $message,
                user: $user,
                imageUrl: $imgUrl
            ));
        } catch (\Exception $e) {
//            return redirect()->back()->with('error', $e->getMessage());
        }
    }


    public function sendNotificationToGuest($users,$request,$imgUrl)
    {


        foreach ($users as $user){

            if (!$user || !$user->endpoint) {
                return response()->json(['error' => 'Invalid subscription data'], 400);
            }


            $subscription = Subscription::create([
                'endpoint' => $user->endpoint,
                'keys' => [
                    'p256dh' => $user->public_key,
                    'auth' => $user->auth_token,
                ],
            ]);


            $webPush = new WebPush([
                'VAPID' => [
                    'subject' => 'mailto:faizan055ali@gmail.com',
                    'publicKey' => env('VAPID_PUBLIC_KEY'),
                    'privateKey' => env('VAPID_PRIVATE_KEY'),
                ],
            ]);



            $notification = [
                'title' => $request->title,
                'body' => $request->body,
                'icon' => $imgUrl ?? null,
                'image' => $imgUrl ?? null
            ];


            $webPush->sendOneNotification($subscription, json_encode($notification));
        }
    }





}
