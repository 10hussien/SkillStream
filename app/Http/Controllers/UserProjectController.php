<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserProjectRequest;
use App\Models\CourseProject;
use App\Models\User;
use App\Models\UserProject;
use App\utils\translate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserProjectController extends Controller
{



    public function registerProject($project_id)
    {
        $project = CourseProject::Project($project_id);

        if ($project == 'this project not found') {

            return response()->json((new translate)->translate($project), 404);
        }
        $add = UserProject::FirstOrCreate([
            'user_id' => Auth::id(),
            'course_project_id' => $project_id,
            'project_link' => '127.0.0.1:8000/api/registerProject/1?lang=ar',
            'project_score' => '0'
        ]);
        if (!$add) {
            return response()->json((new translate)->translate('There was a problem during registration. Please try again later.'), 404);
        }
        return response()->json((new translate)->translate('The project has been successfully registered.'), 200);
    }

    public function uploadProject(UserProjectRequest $request, $project_id)
    {
        $project = CourseProject::Project($project_id);

        if ($project == 'this project not found') {

            return response()->json((new translate)->translate($project), 404);
        }
        $register = UserProject::where('course_project_id', $project_id)
            ->where('user_id', Auth::id())
            ->first();
        if (empty($register)) {
            return response()->json((new translate)->translate('you dont register this project'));
        }


        $data = $request->input('project_link');

        $register['project_link'] = $data;

        $register->update();

        return response()->json((new translate)->translate('Your project has been uploaded successfully.'));
    }



    public function showRegisterProjectForUser($project_id)
    {
        $project = CourseProject::Project($project_id);

        if ($project == 'this project not found') {

            return response()->json((new translate)->translate($project), 404);
        }

        $user = $project->userProject;

        if (empty($user)) {

            return response()->json((new translate)->translate('This project does not have any registered students.'), 404);
        }
        return response()->json($project, 200);
    }


    public function showUserRigisterToProject($user_id)
    {
        $user = User::find($user_id);
        if (!$user) {
            return response()->json((new translate)->translate('this user not found'), 404);
        }

        $projects = $user->projectUser;

        if ($projects->isEmpty()) {

            return response()->json((new translate)->translate('this user dose not have any register project'));
        }
        return response()->json($projects, 200);
    }





    public function showMyRegisterProject()
    {
        $projects = $this->showUserRigisterToProject(Auth::id());

        if ($projects->original == (new translate)->translate('this user dose not have any register project')) {

            return response()->json((new translate)->translate('this user dose not have any register project'), 404);
        }
        return response()->json($projects->original, 200);
    }
}
