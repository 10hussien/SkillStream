<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('quizzes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('video_course_id');
            $table->text('question_text');
            $table->enum('question_type', ['multiple choice', 'True or false'])->default('multiple choice');
            $table->integer('marks')->default(0);
            $table->timestamps();
            $table->foreign('video_course_id')->references('id')->on('video_courses')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('quizzes');
    }
};
