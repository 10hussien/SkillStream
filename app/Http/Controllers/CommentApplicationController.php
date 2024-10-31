<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentApplicationRequest;
use App\Models\CommentApplication;
use App\utils\translate;
use App\utils\uploadImage;
use App\utils\uploadVideo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentApplicationController extends Controller
{
    public function addCommentForApplication(CommentApplicationRequest $request)
    {
        $comments = $request->all();
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $extension = $file->getClientOriginalExtension();
            if (
                $extension == 'mp4'
                || $extension == 'avi'
                || $extension == 'mov'
            ) {
                $comments['file'] = (new uploadVideo)->uploadvideo($file);
            } else {
                $comments['file'] = (new uploadImage)->uploadimage($file);
            }
            $add = CommentApplication::create([
                'user_id' => Auth::id(),
                'file' => $comments['file'],
                'comment' => $comments['comment']
            ]);
        } else {

            $add = CommentApplication::create([
                'user_id' => Auth::id(),
                'comment' => $comments['comment']
            ]);
        }

        return response()->json((new translate)->translate('add comment has been successfully.'), 200);
    }

    public function updateCommentApplication(Request $request, $comment_id)
    {
        $comment = CommentApplication::find($comment_id);
        if (!$comment) {
            return response()->json((new translate)->translate('This comment no longer exists.'));
        }

        if ($request->hasFile('file')) {

            return response()->json((new translate)->translate('You cannot edit the image within the comment. If you want to edit, you can delete the comment and send a new comment.'));
        }

        if ($request->input('comment')) {

            $comment['comment'] = $request->input('comment');

            $comment->update();
        }

        return response()->json((new translate)->translate('Your comment has been modified.'));
    }


    public function deleteCommentApptication($comment_id)
    {
        $comment = CommentApplication::find($comment_id);
        if (!$comment) {
            return response()->json((new translate)->translate('This comment no longer exists.'));
        }
        $delete = $comment->delete();
        if (!$delete) {
            return response()->json((new translate)->translate('There was a problem deleting, please try again later.'));
        }
        return response()->json((new translate)->translate('Comment has been successfully deleted.'));
    }

    public function showAllComment()
    {
        $comments = CommentApplication::all();
        if ($comments->isEmpty()) {
            return response()->json((new translate)->translate('not found comments'), 404);
        }
        return response()->json($comments, 200);
    }
}
