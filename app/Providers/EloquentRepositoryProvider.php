<?php

namespace App\Providers;

use App\Repositories\Note\EloquentNote;
use Illuminate\Support\ServiceProvider;
use App\Repositories\Admin\EloquentAdmin;
use App\Repositories\Note\NoteRepository;
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
use App\Repositories\Certificate\EloquentCertificate;
use App\Repositories\Evaluation\EvaluationRepository;
use App\Repositories\Certificate\CertificateRepository;
use App\Repositories\TypesExpenses\EloquentTypesExpenses;
use App\Repositories\TypesExpenses\TypesExpensesRepository;
use App\Repositories\EmployeeExpnses\EloquentEmployeeExpnses;
use App\Repositories\PeriodicExpnses\EloquentPeriodicExpnses;
use App\Repositories\EmployeeExpnses\EmployeeExpnsesRepository;
use App\Repositories\PeriodicExpnses\PeriodicExpnsesRepository;
use App\Repositories\SituationalExpnses\EloquentSituationalExpnses;
use App\Repositories\SituationalExpnses\SituationalExpnsesRepository;

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
        $this->app->bind(CertificateRepository::class, EloquentCertificate::class);

        $this->app->bind(NoteRepository::class, EloquentNote::class);

        $this->app->bind(EmployeeExpnsesRepository::class, EloquentEmployeeExpnses::class);
        $this->app->bind(PeriodicExpnsesRepository::class, EloquentPeriodicExpnses::class);
        $this->app->bind(SituationalExpnsesRepository::class, EloquentSituationalExpnses::class);
        $this->app->bind(TypesExpensesRepository::class, EloquentTypesExpenses::class);
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
