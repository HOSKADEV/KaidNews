<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Request;

use App\Http\Controllers\Auth\LoginController;

use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Student\AccountController;

use App\Http\Controllers\Dashboard\Admin\AdminController;
use App\Http\Controllers\Dashboard\DashboardAdminController;
use App\Http\Controllers\Student\StudentDashboardController;
use App\Http\Controllers\Dashboard\Student\StudentController;
use App\Http\Controllers\Dashboard\Teacher\TeacherController;

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

// Main Page Route
// ->middleware('auth')
// Route::get('/', 'App\Http\Controllers\dashboard\Analytics@index')->name('dashboard-analytics')->middleware('auth');


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

Route::prefix('dashboard')->name('dashboard.')->middleware('auth:admin')->group(function () {
    Route::resource('/', DashboardAdminController::class);
    Route::resource('admins', AdminController::class);
    Route::resource('students', StudentController::class);
    Route::resource('teachers', TeacherController::class);
});


Route::name('student.')->middleware('auth:student')->group(function () {
    Route::get('student',[StudentDashboardController::class , 'index']);

    Route::resource('account', AccountController::class);

});

Route::name('teacher.')->middleware('auth:teacher')->group(function () {
    Route::get('teacher', [TeacherDashboardController::class, 'index']);
});

/* ----------------------- End Dashboard -----------------------*/
