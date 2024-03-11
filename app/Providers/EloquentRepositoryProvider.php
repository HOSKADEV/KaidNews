<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Admin\EloquentAdmin;
use App\Repositories\Admin\AdminRepository;
use App\Repositories\Student\EloquentStudent;
use App\Repositories\Teacher\EloquentTeacher;
use App\Repositories\Student\StudentRepository;
use App\Repositories\Teacher\TeacherRepository;

class EloquentRepositoryProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(StudentRepository::class, EloquentStudent::class);
        $this->app->bind(AdminRepository::class, EloquentAdmin::class);
        $this->app->bind(TeacherRepository::class, EloquentTeacher::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
