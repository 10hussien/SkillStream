<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\utils\translate;
use Illuminate\Auth\Events\Verified;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;


class VerifyEmailController extends Controller
{

    public function store(Request $request)
    {
        $number = $request->input('number');
        if ($request->user()->hasVerifiedEmail()) {
            return response()->json((new translate)->translate('Your account has already been confirmed'));
        }
        $numberof = Cache::get('randomNumber');

        if ($number !== $numberof) {
            return response()->json(['status' => __('validation.The code is incorrect, please enter it again')]);
        } else if ($request->user()->markEmailAsVerified() && $number === $numberof) {
            event(new Verified($request->user()));
        }
        return response()->json((new translate)->translate('Your account has been successfully confirmed'));
    }
}
