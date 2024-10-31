<?php

namespace App\Http\Controllers;

use App\Http\Requests\TeacherRequest;
use App\Models\Profile;
use App\Models\Teacher;
use App\Models\User;
use App\utils\translate;
use App\utils\uploadImage;
use App\utils\uploadPdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeacherController extends Controller
{
    public function addTeacher(TeacherRequest $request)
    {
        $teacher = $request->all();

        if ($request->hasFile('cv')) {

            $teacher['cv'] = (new uploadPdf)->uploadpdf($request->cv);
        }

        $teacher['user_id'] = Auth::id();

        Teacher::create($teacher);

        return response()->json((new translate)->translate('Your profile as a teacher has been successfully added,awaiting acceptance by the owner. '));
    }


    public function showAllTeacher()
    {
        $users = User::where('role', 'teacher')->get();

        if ($users->isEmpty()) {

            return response()->json((new translate)->translate('I dont have any teacher'));
        }

        foreach ($users as $user) {

            if ($user->teacher->approved == 1) {

                $teacher = $user->teacher;

                $profile = $user->profile;
            }
        }

        return response()->json($users, 200);
    }


    public function showTeacher($id)
    {
        $user = Teacher::Teacher($id);

        if ($user == 'Teacher not found') {

            return response()->json((new translate)->translate($user));
        }

        $profile = $user->profile;
        return response()->json($user);
    }


    public function showMyCV()
    {

        $user = Teacher::Teacher(Auth::id());

        if ($user == 'Teacher not found') {

            return response()->json((new translate)->translate($user));
        }

        return response()->json($user);
    }


    public function updateTeacher(Request $request)
    {

        $user = Teacher::Teacher(Auth::id());

        if ($user == 'Teacher not found') {

            return response()->json((new translate)->translate($user));
        }

        $teacher = $user->teacher;

        $teacher->update($request->all());

        if ($request->hasFile('cv')) {

            $teacher['cv'] = (new uploadPdf)->uploadpdf($request->cv);
        }

        $teacher->save();

        return response()->json((new translate)->translate('Your profile as a teacher has been successfully update.'));
    }

    public function deleteTeacher()
    {
        $teacher = Teacher::Teacher(Auth::id());

        if ($teacher == 'Teacher not found') {

            return response()->json((new translate)->translate($teacher));
        }
        $teacher->delete();

        return response()->json((new translate)->translate('Your profile as a teacher has been successfully delete'));
    }
}
