<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentProjectRequest;
use App\Models\CommentProject;
use App\Models\CourseProject;
use App\utils\translate;
use App\utils\uploadImage;
use App\utils\uploadVideo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentProjectController extends Controller
{
    public function addComment(CommentProjectRequest $request, $project_id)
    {
        $project = CourseProject::Project($project_id);
        if ($project == 'this project not found') {
            return response()->json((new translate)->translate($project), 404);
        }
        $comments = $request->all();
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            if (
                $file->getClientOriginalExtension() == 'mp4'
                || $file->getClientOriginalExtension() == 'avi'
                || $file->getClientOriginalExtension() == 'mov'
            ) {
                $comments['file'] = (new uploadVideo)->uploadvideo($file);
            } else {
                $comments['file'] = (new uploadImage)->uploadimage($file);
            }

            $add = CommentProject::create([
                'user_id' => Auth::id(),
                'course_project_id' => $project_id,
                'file' => $comments['file'],
                'comment' => $comments['comment']
            ]);
        } else {

            $add = CommentProject::create([
                'user_id' => Auth::id(),
                'course_project_id' => $project_id,
                'comment' => $comments['comment']
            ]);
        }
        if (!$add) {
            return response()->json((new translate)->translate('A problem occurred, please try again later.'), 404);
        }
        return response()->json((new translate)->translate('Comment added successfully'), 200);
    }

    public function updateComment(Request $request, $comment_id)
    {
        $comment = CommentProject::find($comment_id);

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

    public function deleteComment($comment_id)
    {
        $comment = CommentProject::find($comment_id);
        if (!$comment) {
            return response()->json((new translate)->translate('This comment no longer exists.'));
        }
        $delete = $comment->delete();
        if (!$delete) {
            return response()->json((new translate)->translate('There was a problem deleting, please try again later.'));
        }
        return response()->json((new translate)->translate('Comment has been successfully deleted.'));
    }


    public function allCommentToProject($project_id)
    {
        $project = CourseProject::Project($project_id);
        if ($project == 'this project not found') {
            return response()->json((new translate)->translate($project), 404);
        }

        $comments = CommentProject::where('course_project_id', $project_id)->get();

        if ($comments->isEmpty()) {
            return response()->json((new translate)->translate('There are no comments on this project.'), 404);
        }
        foreach ($comments as $comment) {
            $users = $comment->user;
        }
        return response()->json($comments, 200);
    }
}
