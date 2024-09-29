<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class ProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();



        DB::table('profiles')->insert([

            [

                'user_id' => 1,

                'personal_photo' => $faker->image,

                'address' => 'Damascus',

                'date' => '13-7-2003',

                'nationality' => 'syria',

                'gender' => 'male',

            ],

            [

                'user_id' => 2,

                'personal_photo' => $faker->image,

                'address' => 'malezea',

                'date' => '21-6-2000',

                'nationality' => 'syria',

                'gender' => 'male',

            ],

            [

                'user_id' => 3,

                'personal_photo' => $faker->image,

                'address' => 'Damascus',

                'date' => '13-10-2009',

                'nationality' => 'syria',

                'gender' => 'male',

            ],

            [

                'user_id' => 4,

                'personal_photo' => $faker->image,

                'address' => 'Al-seda Zaenab',

                'date' => '7-4-2003',

                'nationality' => 'syria',

                'gender' => 'male',

            ],

        ]);
    }
}
