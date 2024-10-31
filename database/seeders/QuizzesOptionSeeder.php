<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QuizzesOptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('quiz_options')->insert([
            [
                'quizzes_id' => 1,
                'option_text' => 'MF',
                'is_correct' => 1,
                // 'interpretation' => '',
            ],
            [
                'quizzes_id' => 1,
                'option_text' => 'UHF and SHF',
                'is_correct' => 0,
                // 'interpretation' => '',
            ],
            [
                'quizzes_id' => 1,
                'option_text' => 'HF',
                'is_correct' => 0,
                // 'interpretation' => '',
            ],
            [
                'quizzes_id' => 1,
                'option_text' => 'LF',
                'is_correct' => 0,
                // 'interpretation' => '',
            ],
            [
                'quizzes_id' => 2,
                'option_text' => 'LPF type T',
                'is_correct' => 1,
                // 'interpretation' => '',
            ],
            [
                'quizzes_id' => 2,
                'option_text' => 'LPF type 𝝅',
                'is_correct' => 0,
                // 'interpretation' => '',
            ],
            [
                'quizzes_id' => 2,
                'option_text' => 'HPF type 𝝅',
                'is_correct' => 0,
                // 'interpretation' => '',
            ],
            [
                'quizzes_id' => 3,
                'option_text' => 'Broadcast radio',
                'is_correct' => 0,
                // 'interpretation' => '',
            ],
            [
                'quizzes_id' => 3,
                'option_text' => 'Far Broadcast radio',
                'is_correct' => 0,
                // 'interpretation' => '',
            ],
            [
                'quizzes_id' => 3,
                'option_text' => 'Radar Systems',
                'is_correct' => 0,
                // 'interpretation' => '',
            ],
            [
                'quizzes_id' => 3,
                'option_text' => 'Line of sight Transmission',
                'is_correct' => 1,
                // 'interpretation' => '',
            ],
            [
                'quizzes_id' => 4,
                'option_text' => 'BPF',
                'is_correct' => 1,
                // 'interpretation' => '',
            ],
            [
                'quizzes_id' => 4,
                'option_text' => 'LPF',
                'is_correct' => 0,
                // 'interpretation' => '',
            ],
            [
                'quizzes_id' => 4,
                'option_text' => 'HPF',
                'is_correct' => 0,
                // 'interpretation' => '',
            ],
            [
                'quizzes_id' => 4,
                'option_text' => 'BSF',
                'is_correct' => 0,
                // 'interpretation' => '',
            ],
            [
                'quizzes_id' => 5,
                'option_text' => 'PPM',
                'is_correct' => 0,
                // 'interpretation' => '',
            ],
            [
                'quizzes_id' => 5,
                'option_text' => 'PM',
                'is_correct' => 0,
                // 'interpretation' => '',
            ],
            [
                'quizzes_id' => 5,
                'option_text' => 'FM',
                'is_correct' => 0,
                // 'interpretation' => '',
            ],
            [
                'quizzes_id' => 5,
                'option_text' => 'AM',
                'is_correct' => 1,
                // 'interpretation' => '',
            ],
            [
                'quizzes_id' => 6,
                'option_text' => 'PAM',
                'is_correct' => 0,
                // 'interpretation' => '',
            ],
            [
                'quizzes_id' => 6,
                'option_text' => 'PPM',
                'is_correct' => 1,
                // 'interpretation' => '',
            ],
            [
                'quizzes_id' => 6,
                'option_text' => 'PWM',
                'is_correct' => 0,
                // 'interpretation' => '',
            ],
            [
                'quizzes_id' => 6,
                'option_text' => 'none',
                'is_correct' => 0,
                // 'interpretation' => '',
            ],
            [
                'quizzes_id' => 7,
                'option_text' => 'attenuation',
                'is_correct' => 0,
                // 'interpretation' => '',
            ],
            [
                'quizzes_id' => 7,
                'option_text' => 'multi-paths Interference',
                'is_correct' => 1,
                // 'interpretation' => '',
            ],
            [
                'quizzes_id' => 7,
                'option_text' => 'electromagnetic interference',
                'is_correct' => 0,
                // 'interpretation' => '',
            ],
            [
                'quizzes_id' => 7,
                'option_text' => 'delay distortion',
                'is_correct' => 0,
                // 'interpretation' => '',
            ],


            [
                'quizzes_id' => 8,
                'option_text' => 'PPM modulation',
                'is_correct' => 0,
                // 'interpretation' => '',
            ],
            [
                'quizzes_id' => 8,
                'option_text' => 'ASK modulation',
                'is_correct' => 0,
                // 'interpretation' => '',
            ],
            [
                'quizzes_id' => 8,
                'option_text' => 'FSK modulation',
                'is_correct' => 0,
                // 'interpretation' => '',
            ],
            [
                'quizzes_id' => 8,
                'option_text' => 'PSK modulation',
                'is_correct' => 1,
                // 'interpretation' => '',
            ],
            [
                'quizzes_id' => 9,
                'option_text' => 'Digital carrier',
                'is_correct' => 0,
                // 'interpretation' => '',
            ],
            [
                'quizzes_id' => 9,
                'option_text' => 'Analog Pulse',
                'is_correct' => 0,
                // 'interpretation' => '',
            ],
            [
                'quizzes_id' => 9,
                'option_text' => 'Digital pulse',
                'is_correct' => 0,
                // 'interpretation' => '',
            ],
            [
                'quizzes_id' => 9,
                'option_text' => 'continuous wave',
                'is_correct' => 1,
                // 'interpretation' => '',
            ],
            [
                'quizzes_id' => 10,
                'option_text' => 'الحاملcarrier signal,المعلوماتdata signal',
                'is_correct' => 0,
                // 'interpretation' => '',
            ],
            [
                'quizzes_id' => 10,
                'option_text' => 'المعلوماتdata signal, الحاملcarrier signal',
                'is_correct' => 1,
                // 'interpretation' => '',
            ],
            [
                'quizzes_id' => 10,
                'option_text' => 'رقميةDigital signal, تماثليةanalog signal',
                'is_correct' => 0,
                // 'interpretation' => '',
            ],
            [
                'quizzes_id' => 10,
                'option_text' => 'تماثليةanalog signal, رقميةDigital signal',
                'is_correct' => 0,
                // 'interpretation' => '',
            ],



        ]);
    }
}
