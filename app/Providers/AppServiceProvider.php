<?php

namespace App\Providers;

use App\Models\Teacher;
use App\Observers\ApprovedTeacher;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Teacher::observe(ApprovedTeacher::class);
    }
}
