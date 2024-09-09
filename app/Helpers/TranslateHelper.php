<?php

namespace App\Helpers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Queue;
use Stichoza\GoogleTranslate\GoogleTranslate;

class TranslateHelper
{

    public static function batchTranslate(string $text): string
    {

        //if auth user then get language from user

        if(auth()->check()){
            $targetLanguage = auth()->user()->language;
        }else{
            $targetLanguage = \request()->header('toTranslate') ? \request()->header('toTranslate') : 'en';
        }
//        dd($targetLanguage);

//        $targetLanguage = \request()->header('toTranslate', 'en');
        $cacheKey = self::getCacheKey($text, $targetLanguage);

        // Check cache first
        if (Cache::has($cacheKey)) {
            return Cache::get($cacheKey);
        }

        // Translate text
        $tr = new GoogleTranslate($targetLanguage);
        $translatedText = $tr->translate($text);
        Cache::put($cacheKey, $translatedText, 3600); // Cache for 1 hour

        return $translatedText;
    }

    private static function getCacheKey(string $text, string $language): string
    {
        return md5($text . '_' . $language);
    }




    public static function notificationTranslate(string $text,$translateTo): string
    {


        $cacheKey = self::getCacheKey($text, $translateTo);

        // Check cache first
        if (Cache::has($cacheKey)) {
            return Cache::get($cacheKey);
        }

        // Translate text
        $tr = new GoogleTranslate($translateTo);
        $translatedText = $tr->translate($text);
        Cache::put($cacheKey, $translatedText, 3600); // Cache for 1 hour

        return $translatedText;
    }



}
