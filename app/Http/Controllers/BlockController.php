<?php

namespace App\Http\Controllers;

use App\Models\Block;
use App\Models\User;
use App\utils\translate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BlockController extends Controller
{
    public function block($user_id)

    {
        $user = User::find($user_id);
        if (!$user) {
            return response()->json((new translate)->translate('this user not found'), 404);
        }

        if ($user_id == Auth::id()) {
            return response()->json((new translate)->translate('You can not block yourself.'));
        }
        Block::FirstOrCreate([
            'user_id' => Auth::id(),
            'blocked_user_id' => $user_id
        ]);
        return response()->json(['message' => (new translate)->translate('User  has been blocked')]);
    }


    public function unblock($user_id)
    {
        $user = User::find($user_id);

        if (!$user) {

            return response()->json((new translate)->translate('this user not found'), 404);
        }

        $block = Block::where('user_id', Auth::id())
            ->where('blocked_user_id', $user_id)
            ->first();

        if (!$block) {
            return response()->json((new translate)->translate('you are not bloced this user.'), 404);
        }

        $block->delete();

        return response()->json(['message' => (new translate)->translate('User  has been unblocked')]);
    }

    public function showAllBlock()
    {
        $user = Auth::user();
        $allBlock = $user->blockedUsers;
        if (!$allBlock) {
            return response()->json((new translate)->translate('You have not blocked anyone.'), 404);
        }
        return response()->json($allBlock, 200);
    }
}
