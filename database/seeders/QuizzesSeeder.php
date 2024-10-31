<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QuizzesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('quizzes')->insert([
            [
                'video_course_id' => 1,
                'question_text' => 'AM Radio operates on...... frequency bands',
                'question_type' => 'multiple choice',
                'marks' => 2
            ],
            [
                'video_course_id' => 1,
                'question_text' => 'For below circuit ,what is the filter type?',
                'question_type' => 'multiple choice',
                'marks' => 2
            ],
            [
                'video_course_id' => 1,
                'question_text' => 'Microwave Links are good example of..... communication:',
                'question_type' => 'multiple choice',
                'marks' => 2
            ],
            [
                'video_course_id' => 1,
                'question_text' => 'AM Radio operates on .... frequency bands?',
                'question_type' => 'multiple choice',
                'marks' => 2
            ],
            [
                'video_course_id' => 1,
                'question_text' => 'Which Modulation requires envelop detecting circuit on receiver side?',
                'question_type' => 'multiple choice',
                'marks' => 2
            ],
            [
                'video_course_id' => 2,
                'question_text' => 'Comparing below pulse Modulation types according to noise immunity,
the .... is the best?',
                'question_type' => 'multiple choice',
                'marks' => 2
            ],
            [
                'video_course_id' => 2,
                'question_text' => 'Reflection from land, water and natural or human-made objects can
create...',
                'question_type' => 'multiple choice',
                'marks' => 2
            ],
            [
                'video_course_id' => 2,
                'question_text' => 'Which modulation is used to generate the below modulation signal',
                'question_type' => 'multiple choice',
                'marks' => 2
            ],
            [
                'video_course_id' => 2,
                'question_text' => 'AM, FM, PM are types of....modulation',
                'question_type' => 'multiple choice',
                'marks' => 2
            ],
            [
                'video_course_id' => 2,
                'question_text' => 'Modulation is process which involves manipulation of one parameter
(A,F,𝝓) of a ... signal by another ... signal',
                'question_type' => 'multiple choice',
                'marks' => 2
            ],



        ]);
    }
}
