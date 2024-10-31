<?php

namespace App\Http\Middleware;

use App\Models\CommentProject;
use App\utils\translate;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class ControlComment
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::id();
        $comment_id = $request->route('comment_id');
        $comment = CommentProject::find($comment_id);
        if (!$comment) {
            return response()->json((new translate)->translate('This comment no longer exists.'), 404);
        }
        if ($comment['user_id'] != $user) {
            return response()->json((new translate)->translate('You do not have control  this comment.'), 401);
        }
        return $next($request);
    }
}
