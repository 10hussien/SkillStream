<?php

namespace App\Http\Controllers;

use App\Http\Requests\CourseProjectRequest;
use App\Models\Course;
use App\Models\CourseProject;
use App\utils\translate;

class CourseProjectController extends Controller
{
    public function addProjectToCourse(CourseProjectRequest $request, $course_id)
    {

        $course = Course::Course($course_id);

        if ($course == 'There are no course') {
            return response()->json((new translate)->translate($course), 404);
        }

        $projects = $request->input('projects');

        if (empty($projects)) {
            return response()->json((new translate)->translate('you dont add any project to this course'), 404);
        }
        foreach ($projects as $project) {
            $add = CourseProject::FirstOrCreate([
                'course_id' => $course_id,
                'project_name' => $project['project_name'],
                'project_description' => $project['project_description'],
                'project_start' => $project['project_start'],
                'project_end' => $project['project_end'],
                'project_status' => $$project['project_start']
            ]);
            if (!$add) {
                return response()->json((new translate)->translate('There is a problem with this add-on, please try adding it later.'), 404);
            }
        }
        return response()->json((new translate)->translate('Projects added successfully'), 200);
    }

    public function showProjectToCourse($course_id)
    {
        $course = Course::Course($course_id);

        if ($course == 'There are no course') {
            return response()->json((new translate)->translate($course), 404);
        }
        $projects = $course->projectsCourse;

        if (empty($projects)) {
            return response()->json((new translate)->translate('there dont have any project for this course'), 404);
        }

        foreach ($projects as $project) {
            $course = $this->showDescriptionProject($project->id);
            $CourseProjects[] = $course->original;
        }
        return response()->json($CourseProjects, 200);
    }


    public function showDescriptionProject($project_id)
    {
        $project = CourseProject::Project($project_id);
        if ($project == 'this project not found') {
            return response()->json((new translate)->translate($project), 404);
        }
        $project_status = $project->project_status;
        if ($project_status == 'Not start') {
            $message = 'this project does not start to now ';
        } elseif ($project_status == 'started') {
            $message = 'This project is under construction.';
        } elseif ($project_status == 'finshed') {
            $message = 'This project had fish  .';
        }
        return response()->json(['project' => $project, 'message' => (new translate)->translate($message)], 200);
    }
}
