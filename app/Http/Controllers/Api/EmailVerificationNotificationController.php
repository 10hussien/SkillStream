<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\utils\translate;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Cache;


class EmailVerificationNotificationController extends Controller
{
    public function store(Request $request): JsonResponse
    {

        if ($request->user()->hasVerifiedEmail()) {
            return response()->json((new translate)->translate('Your account has already been confirmed'));
        }

        $randomNumber = str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT);
        VerifyEmail::toMailUsing(function (object $notifia) use ($randomNumber) {
            return (new MailMessage)
                ->subject('Verify Email')
                ->line((new translate)->translate('This code was sent to verify the validity of your email'))
                ->line($randomNumber)
                ->line((new translate)->translate('This Verify email code will expire in 60 minutes'));
        });
        $request->user()->sendEmailVerificationNotification();
        Cache::put('randomNumber', $randomNumber, 86400);

        return response()->json((new translate)->translate('The code has been sent to your email'));
    }
}
