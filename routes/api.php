<?php

use App\Http\Controllers\AdditionalResourceController;
use App\Http\Controllers\ApprovedController;
use App\Http\Controllers\BlockController;
use App\Http\Controllers\CommentApplicationController;
use App\Http\Controllers\CommentProjectController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\CourseProjectController;
use App\Http\Controllers\DownloadVideoController;
use App\Http\Controllers\FollowerTeacherController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QuestionAnswerController;
use App\Http\Controllers\QuestionBankController;
use App\Http\Controllers\QuizAnswerController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\QuizScoreController;
use App\Http\Controllers\ScoreFinalController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\UserCourseController;
use App\Http\Controllers\UserProjectController;
use App\Http\Controllers\VideoCourseController;
use App\Http\Controllers\VideoSizeController;
use App\Http\Controllers\VideoViewsController;
use Illuminate\Support\Facades\Route;


Route::middleware(['auth:sanctum', 'setapplang'])->group(function () {
    Route::post('addProfile', [ProfileController::class, 'addProfile'])->name('addProfile');
    Route::get('showMyProfile', [ProfileController::class, 'showMyProfile'])->name('showMyProfile');
    Route::get('showProfile/{user_id}', [ProfileController::class, 'showProfile'])->name('showProfile');
    Route::post('updateProfile', [ProfileController::class, 'updateProfile'])->name('updateProfile');
    Route::get('deleteProfile', [ProfileController::class, 'deleteProfile'])->name('deleteProfile');
});


Route::middleware(['auth:sanctum', 'setapplang'])->group(function () {
    Route::post('addTeacher', [TeacherController::class, 'addTeacher'])->name('addTeacher');
    Route::get('showMyCV', [TeacherController::class, 'showMyCV'])->name('showMyCV');
    Route::get('showTeacher/{user_id}', [TeacherController::class, 'showTeacher'])->name('showTeacher');
    Route::get('showAllTeacher', [TeacherController::class, 'showAllTeacher'])->name('showAllTeacher');
    Route::post('updateTeacher', [TeacherController::class, 'updateTeacher'])->name('updateTeacher');
    Route::get('deleteTeacher', [TeacherController::class, 'deleteTeacher'])->name('deleteTeacher');
});

Route::middleware(['auth:sanctum', 'setapplang', 'owner'])->group(function () {
    Route::get('showTeacherNotAccept', [ApprovedController::class, 'showTeacherNotAccept']);
    Route::post('teacherAccept/{id}', [ApprovedController::class, 'teacherAccept']);
});

Route::middleware(['auth:sanctum', 'setapplang', 'teacher'])->group(function () {
    Route::post('addCourse', [CourseController::class, 'addCourse']);
});

Route::middleware(['auth:sanctum', 'setapplang', 'controlCourse'])->group(function () {
    Route::post('updateCourse/{course_id}', [CourseController::class, 'updateCourse']);
    Route::get('deleteCourse/{course_id}', [CourseController::class, 'deleteCourse']);
});


Route::middleware(['auth:sanctum', 'setapplang'])->group(function () {
    Route::get('showCourse/{id}', [CourseController::class, 'showCourse']);
    Route::get('showAllCoursesForTeacher/{user_id}', [CourseController::class, 'showAllCoursesForTeacher']);
});

Route::middleware(['auth:sanctum', 'setapplang'])->group(function () {
    Route::post('registerCourse/{id}', [UserCourseController::class, 'registerCourse']);
    Route::post('UsersRegisteredInTheCourse/{course_id}', [UserCourseController::class, 'UsersRegisteredInTheCourse']);
    Route::post('CoursesRegisteredByUsers/{user_id}', [UserCourseController::class, 'CoursesRegisteredByUsers']);
    Route::get('RegisterMyCourses', [UserCourseController::class, 'RegisterMyCourses']);
    Route::get('DeleteCourseRegistration/{course_id}', [UserCourseController::class, 'DeleteCourseRegistration']);
});


Route::middleware(['auth:sanctum', 'setapplang', 'controlCourse'])->group(function () {
    Route::post('addVideo/{course_id}', [VideoCourseController::class, 'addVideo']);
    Route::post('updateVideo/{video_course_id}', [VideoCourseController::class, 'updateVideo']);
    Route::get('deleteVideo/{video_course_id}', [VideoCourseController::class, 'deleteVideo']);
});

Route::middleware(['auth:sanctum', 'setapplang', 'controlVideo'])->group(function () {
    Route::post('updateVideo/{video_course_id}', [VideoCourseController::class, 'updateVideo']);
    Route::get('deleteVideo/{video_course_id}', [VideoCourseController::class, 'deleteVideo']);
});


Route::middleware(['auth:sanctum', 'setapplang'])->group(function () {
    Route::get('showCourseVideo/{course_id}', [VideoCourseController::class, 'showCourseVideo']);
    Route::get('showDescriptionVideo/{video_course_id}', [VideoCourseController::class, 'showDescriptionVideo']);
    Route::get('showAllVideoToTeacher/{user_id}', [VideoCourseController::class, 'showAllVideoToTeacher']);
});

Route::middleware(['auth:sanctum', 'setapplang'])->group(function () {
    Route::get('showResolutionVideo/{video_course_id}', [VideoSizeController::class, 'showResolutionVideo']);
    Route::get('changeResolution/{video_course_id}', [VideoSizeController::class, 'changeResolution']);
});


Route::middleware(['auth:sanctum', 'setapplang'])->group(function () {
    Route::get('viewvideos', [VideoViewsController::class, 'viewedVideo']);
    Route::get('vieweduser/{video_course_id}', [VideoViewsController::class, 'viewedUser']);
});


Route::middleware(['auth:sanctum', 'setapplang', 'downloadVideo'])->group(function () {
    Route::get('dwonloadVideo/{video_course_id}', [DownloadVideoController::class, 'dwonloadVideo']);
});

Route::middleware(['auth:sanctum', 'setapplang'])->group(function () {
    Route::get('allDownloadVideo', [DownloadVideoController::class, 'allDownloadVideo']);
    Route::get('AllUserDownload/{video_course_id}', [DownloadVideoController::class, 'AllUserDownload']);
});

Route::middleware(['auth:sanctum', 'setapplang', 'controlVideo'])->group(function () {
    Route::post('addQuestionToVideo/{video_course_id}', [QuizController::class, 'addQuestionToVideo']);
});

Route::middleware(['auth:sanctum', 'setapplang'])->group(function () {
    // Route::post('addOptionToQuestion/{quiz_id}', [QuizOptionController::class, 'addOptionToQuestion']);
    Route::get('allQuestionToVideo/{video_course_id}', [QuizController::class, 'allQuestionToVideo']);
    Route::get('showQuestion/{quiz_id}', [QuizController::class, 'showQuestion']);
});


Route::middleware(['auth:sanctum', 'setapplang'])->group(function () {
    Route::post('solutionQuiz', [QuizAnswerController::class, 'solutionQuiz']);
    // Route::post('solutionQuiz/{quiz_id}', [QuizAnswerController::class, 'solutionQuiz']);
    Route::get('allSolutionToVideo/{video_course_id}', [QuizAnswerController::class, 'allSolutionToVideo']);
});
Route::middleware(['auth:sanctum', 'setapplang'])->group(function () {
    Route::get('socreVideoQuiz/{video_course_id}', [QuizScoreController::class, 'socreVideoQuiz']);
    Route::get('allScorToQuizzes/{course_id}', [QuizScoreController::class, 'allScorToQuizzes']);
});

Route::middleware(['auth:sanctum', 'setapplang', 'controlCourse'])->group(function () {
    Route::post('addQuestionToBank/{course_id}', [QuestionBankController::class, 'addQuestionToBank']);
});

Route::middleware(['auth:sanctum', 'setapplang'])->group(function () {
    // Route::post('addQuestionOption/{question_id}', [QuestionOptionController::class, 'addQuestionOption']);
    Route::get('showQuestionBank/{question_id}', [QuestionBankController::class, 'showQuestionBank']);
    Route::get('showQuestionForUser/{course_id}', [QuestionBankController::class, 'showQuestionForUser']);
});

Route::middleware(['auth:sanctum', 'setapplang'])->group(function () {
    Route::post('solveQuestion', [QuestionAnswerController::class, 'solveQuestion']);
    Route::get('solvedUser/{course_id}', [QuestionAnswerController::class, 'solvedUser']);
    Route::get('scoreFinalForUser/{course_id}', [ScoreFinalController::class, 'scoreFinalForUser']);
});

Route::middleware(['auth:sanctum', 'setapplang', 'controlCourse'])->group(function () {
    Route::post('addProjectToCourse/{course_id}', [CourseProjectController::class, 'addProjectToCourse']);
    Route::get('showProjectToCourse/{course_id}', [CourseProjectController::class, 'showProjectToCourse']);
    Route::get('showDescriptionProject/{project_id}', [CourseProjectController::class, 'showDescriptionProject']);
});


Route::middleware(['auth:sanctum', 'setapplang',])->group(function () {
    Route::get('showProjectToCourse/{course_id}', [CourseProjectController::class, 'showProjectToCourse']);
    Route::get('showDescriptionProject/{project_id}', [CourseProjectController::class, 'showDescriptionProject']);
});


Route::middleware(['auth:sanctum', 'setapplang',])->group(function () {
    Route::post('registerProject/{project_id}', [UserProjectController::class, 'registerProject']);
    Route::post('uploadProject/{project_id}', [UserProjectController::class, 'uploadProject']);
    Route::get('showRegisterProjectForUser/{project_id}', [UserProjectController::class, 'showRegisterProjectForUser']);
    Route::get('showUserRigisterToProject/{user_id}', [UserProjectController::class, 'showUserRigisterToProject']);
    Route::get('showMyRegisterProject', [UserProjectController::class, 'showMyRegisterProject']);
});

Route::middleware(['auth:sanctum', 'setapplang',])->group(function () {
    Route::post('addComment/{project_id}', [CommentProjectController::class, 'addComment']);
    Route::post('updateComment/{comment_id}', [CommentProjectController::class, 'updateComment'])->middleware('controlComment');
    Route::get('deleteComment/{comment_id}', [CommentProjectController::class, 'deleteComment'])->middleware('controlComment');
    Route::get('allCommentToProject/{project_id}', [CommentProjectController::class, 'allCommentToProject']);
});


Route::middleware(['auth:sanctum', 'setapplang',])->group(function () {
    Route::post('addResources/{course_id}', [AdditionalResourceController::class, 'addResources'])->middleware('controlCourse');
    Route::get('deleteResourse/{resource_id}', [AdditionalResourceController::class, 'deleteResourse']);
    Route::get('showDescriptionResource/{resource_id}', [AdditionalResourceController::class, 'showDescriptionResource']);
    Route::get('showAllResourcesForCourse/{course_id}', [AdditionalResourceController::class, 'showAllResourcesForCourse']);
});

Route::middleware(['auth:sanctum', 'setapplang',])->group(function () {
    Route::post('addCommentForApplication', [CommentApplicationController::class, 'addCommentForApplication']);
    Route::post('updateCommentApplication/{comment_id}', [CommentApplicationController::class, 'updateCommentApplication'])->middleware('controlCommentApp');
    Route::get('deleteCommentApptication/{comment_id}', [CommentApplicationController::class, 'deleteCommentApptication'])->middleware('controlCommentApp');
    Route::get('showAllComment', [CommentApplicationController::class, 'showAllComment']);
});

Route::middleware(['auth:sanctum', 'setapplang',])->group(function () {
    Route::post('follow/{user_id}', [FollowerTeacherController::class, 'follow']);
    Route::post('unfollow/{user_id}', [FollowerTeacherController::class, 'unfollow']);
    Route::get('showMyFollow', [FollowerTeacherController::class, 'showMyFollow']);
    Route::get('showMyFollowers', [FollowerTeacherController::class, 'showMyFollowers']);
    Route::get('showFollowersForTeacher/{user_id}', [FollowerTeacherController::class, 'showFollowersForTeacher']);
    Route::get('showFollow/{user_id}', [FollowerTeacherController::class, 'showFollow']);
    Route::get('showFollowers/{user_id}', [FollowerTeacherController::class, 'showFollowers']);
});

Route::middleware(['auth:sanctum', 'setapplang',])->group(function () {
    Route::post('block/{user_id}', [BlockController::class, 'block']);
    Route::post('unblock/{user_id}', [BlockController::class, 'unblock']);
    Route::get('showAllBlock', [BlockController::class, 'showAllBlock']);
});
