<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('video_sizes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('video_course_id');
            $table->string('video');
            $table->enum('resolution', ['144p', '240p', '360p', '480p', '720p', '1080p']);
            $table->timestamps();
            $table->foreign('video_course_id')->references('id')->on('video_courses')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('video_sizes');
    }
};
