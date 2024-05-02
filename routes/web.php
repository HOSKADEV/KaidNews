<?php

use Carbon\Carbon;
use Illuminate\Support\Collection;

use Illuminate\Support\Facades\App;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Session;

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Student\AccountController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\Note\NoteController;
use App\Http\Controllers\Dashboard\Admin\AdminController;
use App\Http\Controllers\Dashboard\Print\PrintController;
use App\Http\Controllers\Student\StudentDashboardController;
use App\Http\Controllers\Dashboard\Setting\SettingController;
use App\Http\Controllers\Dashboard\Student\StudentController;
use App\Http\Controllers\Dashboard\Subject\SubjectController;
use App\Http\Controllers\Dashboard\Teacher\TeacherController;
use App\Http\Controllers\Dashboard\Attendence\AttendenceController;
use App\Http\Controllers\Dashboard\Evaluation\EvaluationController;
use App\Http\Controllers\Dashboard\Certificate\CertificateController;
use App\Http\Controllers\Dashboard\ExcelImport\ExcelImportController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
define('PAGINATE_COUNT',100);
Session::put('locale', 'ar');
// define('PAGINATE_COUNT',10);
// ['middleware' => ['auth']],
Route::group([], function () {
    Route::get('/theme/{theme}', function ($theme) {
        Session::put('theme', $theme);
        return redirect()->back();
    });

    Route::get('/lang/{lang}', function ($lang) {
        Session::put('locale', $lang);
        App::setLocale($lang);
        return redirect()->back();
    });
});

Route::get('/', function (Request $request) {
    Session::put('locale', 'ar');
    return to_route('auth.login');
});

/* ----------------------- Start Authentication -----------------------*/
Route::name('auth.')->middleware('guest')->group(function () {
    Route::get('register', [RegisterController::class, 'registerForm'])->name('registerForm');
    Route::post('register', [RegisterController::class, 'register'])->name('register');

    Route::get('login', [LoginController::class, 'loginForm'])->name('loginForm');
    Route::post('login', [LoginController::class, 'submitLogin'])->name('login');
});

Route::get('logout', LogoutController::class)->middleware('auth:admin,student,teacher')
    ->name('auth.logout');
/* ----------------------- End Authentication -----------------------*/


/* ----------------------- Start Dashboard -----------------------*/

// $adminRoute = env('ADMIN_ROUTE');
// $adminRoute = 'admins';


// Route::get('logout', LogoutController::class)->middleware('auth:admin,student,teacher')
//     ->name('auth.logout');

Route::prefix('dashboard')->name('dashboard.')->middleware('auth:admin,teacher')->group(function () {
    Route::resource('/', DashboardController::class);
    Route::post('/analyse/added', [DashboardController::class, 'analyseGetStudentByYear']);
    Route::post('/analyse/gender', [DashboardController::class, 'analyseGetStudentByGender']);
    Route::post('/analyse/point', [DashboardController::class, 'analyseGetStudentByPoint']);

    Route::resource('admins', AdminController::class);
    Route::resource('students', StudentController::class);
    Route::post('import-student-excel', [ExcelImportController::class, 'import'])->name('student.import.excel');

    // import ExcelImportController
    Route::resource('teachers', TeacherController::class);

    Route::resource('attendence', AttendenceController::class);

    Route::resource('subjects', SubjectController::class);
    Route::resource('evaluations', EvaluationController::class);
    Route::get('evaluations/create/{id}', [EvaluationController::class, 'create'])->name('evaluations.create');

    Route::prefix('print')->controller(PrintController::class)->name('print.')->group(function () {
        Route::get('students', 'students')->name('students');
        Route::get('teachers', 'teachers')->name('teachers');
        Route::get('attendence', 'attendence')->name('attendence');
        Route::get('review', 'review')->name('review');
        Route::get('certificate', 'certificate')->name('certificate');
        Route::get('trainee_notebook/{student_id}', 'trainee_notebook')->name('trainee_notebook');
    });

    Route::resource('certificates', CertificateController::class);
    Route::resource('settings', SettingController::class)->middleware('auth:admin');
});


Route::name('student.')->middleware('auth:student')->group(function () {
    Route::get('student', [StudentDashboardController::class, 'index'])->name('index');
    Route::get('student/{student_id}', [StudentDashboardController::class, 'indexAdmin'])->name('index.admin');
    Route::resource('account', AccountController::class);
    Route::post('notes', [NoteController::class, 'store'])->name('notes.store');
});

Route::prefix('download')->middleware('auth:admin,student')->controller(PrintController::class)->name('download.')->group(function () {
    Route::get('reviews/{student_id}', 'review')->name('review');
    Route::get('certificate/{student_id}', 'certificate')->name('certificate');
    Route::get('student/modal', 'studentModel')->middleware('auth:admin')->name('studentModel');


    // CertificateController
    // certificates
});
/* ----------------------- End Dashboard -----------------------*/

