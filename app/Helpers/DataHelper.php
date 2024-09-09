<?php

namespace App\Helpers;

class DataHelper
{
    public static function getGreeting()
    {
        $hour = date('H');
        if ($hour < 12) {
            return "Good morning";
        } elseif ($hour < 18) {
            return "Good afternoon";
        } elseif ($hour < 21) {
            return "Good evening";
        } else {
            return "Good night";
        }
    }
}
