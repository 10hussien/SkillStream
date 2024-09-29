<?php

namespace App\utils;

use Illuminate\Support\Str;

class uploadImage
{

    public function uploadimage($image)
    {
        $image_name = Str::uuid() . date('YmdHis') . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('images'), $image_name);
        return  $image_name;
    }
}
