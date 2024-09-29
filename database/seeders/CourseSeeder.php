<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('courses')->insert([
            [
                'id' => 1,
                'user_id' => 2,
                'title' => 'laravel 10',
                'description' => 'For developing web applications. Laravel 10 Features It provides a data migration system that provides mechanisms for creating and modifying database tables [1]. It provides a powerful routing system for processing and managing web application paths [1]. Laravel 10 Disadvantages
The Laravel framework is relatively slow when compared to some other web development frameworks [1]. Although it is highly secure, it is still at risk of being targeted by security vulnerabilities due to its reliance on PHP, which has been marked with many security vulnerabilities, especially in older versions of it [1]. Its cost is high, as sites developed with the Laravel framework may be relatively more expensive than sites developed with other web technologies such as systems',
                'duration' => '01:35:00',
            ],
            [
                'id' => 2,
                'user_id' => 2,
                'title' => 'laravel 8',
                'description' => 'For developing web applications. Laravel 8 Features It provides a data migration system that provides mechanisms for creating and modifying database tables [1]. It provides a powerful routing system for processing and managing web application paths [1]. Laravel 8 Disadvantages
The Laravel framework is relatively slow when compared to some other web development frameworks [1]. Although it is highly secure, it is still at risk of being targeted by security vulnerabilities due to its reliance on PHP, which has been marked with many security vulnerabilities, especially in older versions of it [1]. Its cost is high, as sites developed with the Laravel framework may be relatively more expensive than sites developed with other web technologies such as systems',
                'duration' => '02:35:00',
            ],
            [
                'id' => 3,
                'user_id' => 2,
                'title' => 'php 8',
                'description' => 'For developing web applications. php 8 Features It provides a data migration system that provides mechanisms for creating and modifying database tables [1]. It provides a powerful routing system for processing and managing web application paths [1]. php 8 Disadvantages
The Laravel framework is relatively slow when compared to some other web development frameworks [1]. Although it is highly secure, it is still at risk of being targeted by security vulnerabilities due to its reliance on PHP, which has been marked with many security vulnerabilities, especially in older versions of it [1]. Its cost is high, as sites developed with the Laravel framework may be relatively more expensive than sites developed with other web technologies such as systems',
                'duration' => '07:35:00',
            ],
            [
                'id' => 4,
                'user_id' => 2,
                'title' => 'MySql',
                'description' => 'For developing web applications. MySql Features It provides a data migration system that provides mechanisms for creating and modifying database tables [1]. It provides a powerful routing system for processing and managing web application paths [1]. Sql Disadvantages
The Laravel framework is relatively slow when compared to some other web development frameworks [1]. Although it is highly secure, it is still at risk of being targeted by security vulnerabilities due to its reliance on PHP, which has been marked with many security vulnerabilities, especially in older versions of it [1]. Its cost is high, as sites developed with the Laravel framework may be relatively more expensive than sites developed with other web technologies such as systems',
                'duration' => '0:55:00',
            ],
            [
                'id' => 5,
                'user_id' => 3,
                'title' => 'Flutter web',
                'description' => 'For developing web applications. Flutter Web  Features It provides a data migration system that provides mechanisms for creating and modifying database tables [1]. It provides a powerful routing system for processing and managing web application paths [1]. Flutter Web Disadvantages
The Laravel framework is relatively slow when compared to some other web development frameworks [1]. Although it is highly secure, it is still at risk of being targeted by security vulnerabilities due to its reliance on Dart, which has been marked with many security vulnerabilities, especially in older versions of it [1]. Its cost is high, as sites developed with the Laravel framework may be relatively more expensive than sites developed with other web technologies such as systems',
                'duration' => '03:00:00',
            ],
            [
                'id' => 6,
                'user_id' => 3,
                'title' => 'Flutter Mobale',
                'description' => 'For developing web applications. Flutter Mobale  Features It provides a data migration system that provides mechanisms for creating and modifying database tables [1]. It provides a powerful routing system for processing and managing web application paths [1]. Flutter Mobale Disadvantages
The Laravel framework is relatively slow when compared to some other web development frameworks [1]. Although it is highly secure, it is still at risk of being targeted by security vulnerabilities due to its reliance on Dart, which has been marked with many security vulnerabilities, especially in older versions of it [1]. Its cost is high, as sites developed with the Laravel framework may be relatively more expensive than sites developed with other web technologies such as systems',
                'duration' => '09:50:00',
            ],
            [
                'id' => 7,
                'user_id' => 3,
                'title' => 'Dart with freamWork Flutter',
                'description' => 'For developing web applications. Dart  Features It provides a data migration system that provides mechanisms for creating and modifying database tables [1]. It provides a powerful routing system for processing and managing web application paths [1]. Dart Disadvantages
The Laravel framework is relatively slow when compared to some other web development frameworks [1]. Although it is highly secure, it is still at risk of being targeted by security vulnerabilities due to its reliance on Dart, which has been marked with many security vulnerabilities, especially in older versions of it [1]. Its cost is high, as sites developed with the Laravel framework may be relatively more expensive than sites developed with other web technologies such as systems',
                'duration' => '03:06:00',
            ],
            [
                'id' => 8,
                'user_id' => 3,
                'title' => 'UiUx',
                'description' => 'For developing web applications. UiUx  Features It provides a data migration system that provides mechanisms for creating and modifying database tables [1]. It provides a powerful routing system for processing and managing web application paths [1]. UiUx Disadvantages
The Laravel framework is relatively slow when compared to some other web development frameworks [1]. Although it is highly secure, it is still at risk of being targeted by security vulnerabilities due to its reliance on UiUx, which has been marked with many security vulnerabilities, especially in older versions of it [1]. Its cost is high, as sites developed with the Laravel framework may be relatively more expensive than sites developed with other web technologies such as systems',
                'duration' => '07:30:00',
            ],
        ]);
    }
}
