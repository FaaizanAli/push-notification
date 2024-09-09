<?php

namespace App\Http\Controllers;

use App\Models\GuestUser;
use Illuminate\Http\Request;
use Minishlink\WebPush\Subscription;
use Minishlink\WebPush\WebPush;

class FrontendController extends Controller
{
    //Index
    public function Index()
    {
        return view('index');
    }

}
