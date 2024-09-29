<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\Forgot_password;
use App\Models\User;
use App\utils\translate;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\ValidationException;

class PasswordResetLinkController extends Controller
{

    public function store(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
        ]);
        $randomNumber = str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT);
        VerifyEmail::toMailUsing(function (object $notifia) use ($randomNumber) {
            return (new MailMessage)
                ->subject('Forgot Password')
                ->line((new translate)->translate('You are receiving this email because we received a password reset request for your account'))
                ->line($randomNumber)
                ->line((new translate)->translate('This password reset code will expire in 60 minutes'));
        });
        $user = User::where('email', $request->email)->first();
        if ($user) {
            $user->sendEmailVerificationNotification();
            Cache::put('forgot_password', $randomNumber, 86400);
            return response()->json((new translate)->translate('The code has been sent to your email'), 200);
        } else {
            return response()->json((new translate)->translate('email not found'), 404);
        }
    }
}
