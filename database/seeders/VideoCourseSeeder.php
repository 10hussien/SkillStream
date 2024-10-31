<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class VideoCourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        DB::table('video_courses')->insert([
            [
                'course_id' => 1,
                'video_url' => "https://youtu.be/1DX8uQkXt7g",
                'description' => 'This video will show you how to install Laravel 10 and solve some installation problems.',
                'title' => 'install Laravel 10',
                'thumbnail' => $faker->image,
                'duration' => '00:27:00',
            ],
            [
                'course_id' => 1,
                'video_url' => "https://youtu.be/1DX8uQkXt7g",
                'description' => 'This video will show you how to install Laravel 10 and solve some installation problems.',
                'title' => ' architecture diagram lavael 10',
                'thumbnail' => $faker->image,
                'duration' => '00:34:00',
            ],
            [
                'course_id' => 1,
                'video_url' => "https://youtu.be/1DX8uQkXt7g",
                'description' => 'Laravel - Default Route Files, Available Router Methods, Redirect, View Routes and Optional Parameters.',
                'title' => '  Default Route ، Methods, Redirect, View and Optional Parameters laravel 10',
                'thumbnail' => $faker->image,
                'duration' => '00:20:00',
            ],
            [
                'course_id' => 1,
                'video_url' => "https://youtu.be/1DX8uQkXt7g",
                'description' => 'Laravel - Default Route Files, Available Router Methods, Redirect, View Routes and Optional Parameters.',
                'title' => '  Creating & Rendering Views laravel 10',
                'thumbnail' => $faker->image,
                'duration' => '00:20:00',
            ],



            [
                'course_id' => 2,
                'video_url' => "https://youtu.be/1DX8uQkXt7g",

                'description' => 'This video will show you how to install Laravel 10 and solve some installation problems.',
                'title' => 'install laravel 8',
                'thumbnail' => $faker->image,
                'duration' => '00:27:00',
            ],
            [
                'course_id' => 2,
                'video_url' => "https://youtu.be/1DX8uQkXt7g",
                'description' => 'This video will show you how to install laravel 8 and solve some installation problems.',
                'title' => ' architecture diagram lavael 10',
                'thumbnail' => $faker->image,
                'duration' => '00:34:00',
            ],
            [
                'course_id' => 2,
                'video_url' => "https://youtu.be/1DX8uQkXt7g",
                'description' => 'Laravel - Default Route Files, Available Router Methods, Redirect, View Routes and Optional Parameters.',
                'title' => '  Default Route ، Methods, Redirect, View and Optional Parameters laravel 8',
                'thumbnail' => $faker->image,
                'duration' => '00:20:00',
            ],


            [
                'course_id' => 2,
                'video_url' => "https://youtu.be/1DX8uQkXt7g",
                'description' => 'Laravel - Default Route Files, Available Router Methods, Redirect, View Routes and Optional Parameters.',
                'title' => '  Creating & Rendering Views laravel 8',
                'thumbnail' => $faker->image,
                'duration' => '00:20:00',
            ],



            [
                'course_id' => 8,
                'video_url' => "https://youtu.be/1DX8uQkXt7g",
                'description' => 'aa',
                'title' => 'How to Become a UI/UX Designer in 2023? | A Beginners Guide',
                'thumbnail' => $faker->image,
                'duration' => '00:02:00',
            ],
            [
                'course_id' => 8,
                'video_url' => "https://youtu.be/1DX8uQkXt7g",
                'description' => 'aa',
                'title' => ' UI Design Principles | Everything You Need To Know',
                'thumbnail' => $faker->image,
                'duration' => '00:10:00',
            ],
            [
                'course_id' => 8,
                'video_url' => "https://youtu.be/1DX8uQkXt7g",
                'description' => 'Adobe acquired Figma for $20 billion, and many designers are worried about this big change. So, in this video, Ill share with you what I think is going to happen to Figma.',
                'title' => '  Adobe Buys Figma – Is It the End of Figma?',
                'thumbnail' => $faker->image,
                'duration' => '00:00:50',
            ],
            [
                'course_id' => 8,
                'video_url' => "https://youtu.be/1DX8uQkXt7g",
                'description' => 'In this video, Im going to show you how to design responsive elements using Figma Auto Layout. You will learn everything you need to know about Figma Auto Layout. We will go over the basics of Auto Layout all the way to creating advanced responsive layouts..',
                'title' => '  Figma Tutorial: Auto Layout | Master Auto Layout in 15 Minutes',
                'thumbnail' => $faker->image,
                'duration' => '00:20:00',
            ],



            [
                'course_id' => 6,
                'video_url' => "https://youtu.be/1DX8uQkXt7g",
                'description' => 'This video will show you how to install Laravel 10 and solve some installation problems.',
                'title' => ' install flutter ( 2023 )',
                'thumbnail' => $faker->image,
                'duration' => '00:27:40',
            ],
            [
                'course_id' => 6,
                'video_url' => "https://youtu.be/1DX8uQkXt7g",
                'description' => 'This video will show you how to install Laravel 10 and solve some installation problems.',
                'title' => 'Create the first project',
                'thumbnail' => $faker->image,
                'duration' => '00:45:25',
            ],
            [
                'course_id' => 6,
                'video_url' => "https://youtu.be/1DX8uQkXt7g",
                'description' => 'This video will show you how to install Laravel 10 and solve some installation problems.',
                'title' => 'Text Widget',
                'thumbnail' => $faker->image,
                'duration' => '00:27:00',
            ],

            [
                'course_id' => 6,
                'video_url' => "https://youtu.be/1DX8uQkXt7g",
                'description' => 'This video will show you how to install Laravel 10 and solve some installation problems.',
                'title' => 'image flutter ',
                'thumbnail' => $faker->image,
                'duration' => '00:05:54',
            ],

        ]);
    }
}
