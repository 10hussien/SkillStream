<?php

namespace Database\Seeders;

use App\utils\uploadPdf;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class TeacherSeeder extends Seeder
{
    public function run(): void
    {

        // $cv = (new uploadPdf)->uploadpdf('C:\Users\ASUS\Downloads\hussien-harajli-CV-20240723.pdf');
        $cv = public_path('pdfs/f33c0424-e4b6-4ef3-90ce-7e196c4522b420240920105200.pdf');

        DB::table('teachers')->insert([

            [
                'id' => 1,

                'user_id' => 2,

                'cv' => $cv,

                'specialization' => 'Back-End Developer',

                'years_of_experience' => '5 years',

                'approved' => 1,

            ],

            [
                'id' => 2,

                'user_id' => 3,

                'cv' => $cv,

                'specialization' => 'Front-End Developer',

                'years_of_experience' => '3 years',

                'approved' => 1,

            ],

        ]);
    }
}
