<?php

namespace App\utils;

use Illuminate\Support\Str;

class uploadPdf
{

    public function uploadpdf($cv)
    {
        $cv_name = Str::uuid() . date('YmdHis') . '.' . $cv->getClientOriginalExtension();
        $cv->move(public_path('pdfs'), $cv_name);
        return  $cv_name;
    }
}
