<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\utils\translate;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;


class NewPasswordController extends Controller
{

    public function store(Request $request): JsonResponse
    {
        $password = $request->validate([
            'email' => 'required|email',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);
        $checkNumber = Cache::get('checkNumber');
        if ($checkNumber) {

            $status = Password::reset(
                $request->only('email', 'password', 'password_confirmation', 'token'),
                function ($user) use ($request) {
                    $user->forceFill([
                        'password' => Hash::make($request->password),
                        'remember_token' => Str::random(60),
                    ])->save();
                    event(new PasswordReset($user));
                }
            );

            if ($status != Password::PASSWORD_RESET) {
                throw ValidationException::withMessages([
                    'email' => [__($status)],
                ]);
            }
            return response()->json((new translate)->translate('The password has been changed successfully'));
        } else {
            return response()->json((new translate)->translate('The password has been changed not  successfully'));
        }
    }

    public function checkNumber(Request $request): JsonResponse
    {
        $validatedData = $request->validate([
            'number' => ['required'],
        ]);

        $forgot_password = Cache::get('forgot_password');

        if ($validatedData['number'] === $forgot_password) {
            Cache::put('checkNumber', true, 86400);
            return response()->json((new translate)->translate('You can change your password now'));
        } else {
            return response()->json((new translate)->translate('The code is incorrect, please enter it again'));
        }
    }
}
