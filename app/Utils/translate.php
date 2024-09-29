<?php

namespace App\utils;

use Faker\Provider\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Stichoza\GoogleTranslate\GoogleTranslate;

class translate
{

    public function translate($message)
    {
        $tr = new GoogleTranslate();
        $lang = app()->getLocale();
        return $tr->setSource('en')->setTarget($lang)->translate($message);
    }
}
