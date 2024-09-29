<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;


class AuthenticatedSessionController extends Controller
{

    public function store(LoginRequest $request): JsonResponse
    {
        $request->authenticate();
        $user = $request->user();

        $user->tokens()->delete();
        $token = $user->createToken('skill_stream');

        return response()->json([
            'Token' => $token->plainTextToken,
            'user' => $user,
            'status' => 200
        ]);
    }


    public function destroy(Request $request): JsonResponse
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['status' => 200]);
    }
}
