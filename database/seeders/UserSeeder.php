<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [

                'id' => 1,

                'first_name' => 'hussien',

                'last_name' => 'harajli',

                'phone' => '0997933208',

                'email' => 'hussien@gmail.com',

                'password' => Hash::make('123123123'),

                'role' => 'owner'

            ],

            [
                'id' => 2,

                'first_name' => 'hadi',

                'last_name' => 'harajli',

                'phone' => '0997933208',

                'email' => 'hadi@gmail.com',

                'password' => Hash::make('123123123'),

                'role' => 'teacher'

            ],

            [
                'id' => 3,

                'first_name' => 'reda',

                'last_name' => 'harajli',

                'phone' => '0997933208',

                'email' => 'reda@gmail.com',

                'password' => Hash::make('123123123'),

                'role' => 'teacher'

            ],

            [
                'id' => 4,

                'first_name' => 'ali',

                'last_name' => 'aljofe',

                'phone' => '0997933208',

                'email' => 'ali@gmail.com',

                'password' => Hash::make('123123123'),

                'role' => 'student'

            ],

            [
                'id' => 5,

                'first_name' => 'hasan',

                'last_name' => 'almohamad',

                'phone' => '0997933208',

                'email' => 'hasn@gmail.com',

                'password' => Hash::make('123123123'),

                'role' => 'student'

            ],


        ]);
    }
}
