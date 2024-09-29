<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserCourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('user_courses')->insert([
            [

                'user_id' => 5,

                'course_id' => 1,

            ],

            [

                'user_id' => 5,

                'course_id' => 2,

            ],

            [

                'user_id' => 5,

                'course_id' => 7,

            ],

            [

                'user_id' => 5,

                'course_id' => 8,

            ],


            [

                'user_id' => 4,

                'course_id' => 2,

            ],

            [

                'user_id' => 4,

                'course_id' => 6,

            ],

            [

                'user_id' => 4,

                'course_id' => 8,

            ],

            [

                'user_id' => 4,

                'course_id' => 1,

            ],


        ]);
    }
}
