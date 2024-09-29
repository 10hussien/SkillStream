<?php

use Illuminate\Support\Facades\Route;
use Stichoza\GoogleTranslate\GoogleTranslate;

Route::get('translate', function () {
    $tr = new GoogleTranslate(); // Translates to 'en' from auto-detected language by default
    echo $tr->setSource('en')->setTarget('ar')->translate('Goodbye');
});
