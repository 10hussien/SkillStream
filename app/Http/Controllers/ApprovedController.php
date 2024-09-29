<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use App\utils\translate;


class ApprovedController extends Controller
{
    public function  teacherAccept($id)
    {
        $teacher = Teacher::find($id);

        if (!$teacher) {

            return response()->json((new translate)->translate('Teacher not found'), 404);
        }

        $teacher['approved'] = true;

        $teacher->save();

        return response()->json((new translate)->translate('The teacher has been accepted'));
    }

    public function showTeacherNotAccept()
    {
        $teachers = Teacher::where('approved', 0)->get();

        if ($teachers->isEmpty()) {

            return response()->json((new translate)->translate('Teacher not found'), 404);
        }

        return response()->json($teachers);
    }
}
