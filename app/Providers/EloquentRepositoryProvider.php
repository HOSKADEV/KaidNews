<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Admin\EloquentAdmin;
use App\Repositories\Admin\AdminRepository;
use App\Repositories\Setting\EloquentSetting;
use App\Repositories\Student\EloquentStudent;
use App\Repositories\Subject\EloquentSubject;
use App\Repositories\Teacher\EloquentTeacher;
use App\Repositories\Setting\SettingRepository;
use App\Repositories\Student\StudentRepository;
use App\Repositories\Subject\SubjectRepository;
use App\Repositories\Teacher\TeacherRepository;
use App\Repositories\Attendence\EloquentAttendence;
use App\Repositories\Evaluation\EloquentEvaluation;
use App\Repositories\Attendence\AttendenceRepository;
use App\Repositories\Evaluation\EvaluationRepository;

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
        
        $this->app->bind(AttendenceRepository::class, EloquentAttendence::class);
        $this->app->bind(SubjectRepository::class, EloquentSubject::class);
        
        $this->app->bind(EvaluationRepository::class, EloquentEvaluation::class);

        $this->app->bind(SettingRepository::class, EloquentSetting::class);
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
