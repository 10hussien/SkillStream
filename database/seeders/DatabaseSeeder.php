<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Course;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            ProfileSeeder::class,
            TeacherSeeder::class,
            CourseSeeder::class,
            UserCourseSeeder::class,
            VideoCourseSeeder::class,
            QuizzesSeeder::class,
            QuizzesOptionSeeder::class
        ]);
    }
}
