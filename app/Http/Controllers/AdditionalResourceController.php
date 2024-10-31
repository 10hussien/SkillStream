<?php

namespace App\Http\Controllers;

use App\Http\Requests\ResourcesRequest;
use App\Models\AdditionalResource;
use App\Models\Course;
use App\utils\translate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdditionalResourceController extends Controller
{
    public function addResources(ResourcesRequest $request, $course_id)
    {
        $course = Course::Course($course_id);
        if ($course == 'There are no course') {
            return response()->json((new translate)->translate($course), 404);
        }
        $resources = $request->input('resources');
        foreach ($resources as $resource) {
            $add = AdditionalResource::create([
                'course_id' => $course_id,
                'resources_type' => $resource['resources_type'],
                'resources_link' => $resource['resources_link']
            ]);
            if (!$add) {
                return response()->json((new translate)->translate('There was a problem adding the resource. Please try again later.'), 404);
            }
        }
        return response()->json((new translate)->translate('Add resources has been successfully.'), 200);
    }

    public function deleteResourse($resource_id)
    {

        $resource = AdditionalResource::find($resource_id);
        if (!$resource) {
            return response()->json((new translate)->translate('this resource not found'), 404);
        }
        $delete = $resource->delete();
        if (!$delete) {
            return response()->json((new translate)->translate('There was a problem delete the resource.'), 404);
        }
        return response()->json((new translate)->translate('Delete resources has been successfully.'), 200);
    }

    public function showDescriptionResource($resource_id)
    {
        $resource = AdditionalResource::find($resource_id);
        if (!$resource) {
            return response()->json((new translate)->translate('this resource not found'), 404);
        }
        $course = $resource->course;

        return response()->json($resource, 200);
    }


    public function showAllResourcesForCourse($course_id)
    {

        $course = Course::Course($course_id);
        if ($course == 'There are no course') {
            return response()->json((new translate)->translate($course), 404);
        }
        $resource = $course->resources;
        if ($resource->isEmpty()) {
            return response()->json((new translate)->translate('this course dose not have any resource'), 404);
        }
        return response()->json($course, 200);
    }
}
