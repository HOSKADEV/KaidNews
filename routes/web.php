<?php

use Carbon\Carbon;
use Illuminate\Support\Collection;

use Illuminate\Support\Facades\Route;

use Illuminate\Support\Facades\Request;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Student\AccountController;

use App\Http\Controllers\Dashboard\DashboardController;
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


// Route::get('logout', LogoutController::class)->middleware('auth:admin,student,teacher')
//     ->name('auth.logout');

Route::prefix('dashboard')->name('dashboard.')->middleware('auth:admin,teacher')->group(function () {
    Route::resource('/', DashboardController::class);

    Route::resource('admins', AdminController::class);
    Route::resource('students', StudentController::class);
    Route::resource('teachers', TeacherController::class);

    Route::resource('attendence', AttendenceController::class);

    Route::resource('subjects', SubjectController::class);
    Route::resource('evaluations', EvaluationController::class);
    Route::get('evaluations/create/{id}', [EvaluationController::class, 'create'])->name('evaluations.create');

    Route::prefix('print')->controller(PrintController::class)->name('print.')->group(function () {
        Route::get('students', 'students')->name('students');
        Route::get('teachers', 'teachers')->name('teachers');
        Route::get('attendence', 'attendence')->name('attendence');
        Route::get('trainee_notebook/{student_id}', 'trainee_notebook')->name('trainee_notebook');
    });

    Route::resource('certificates', CertificateController::class);
    Route::resource('settings', SettingController::class)->middleware('auth:admin');
});


Route::name('student.')->middleware('auth:student')->group(function () {
    Route::get('student', [StudentDashboardController::class, 'index']);
    Route::resource('account', AccountController::class);

    // dashboard.print.attendence
});

Route::prefix('download')->middleware('auth:admin,student')->controller(PrintController::class)->name('download.')->group(function () {
    Route::get('review/{student_id}', 'review')->name('review');
    Route::get('certificate/{student_id}', 'certificate')->name('certificate');


    // CertificateController
    // certificates
});
/* ----------------------- End Dashboard -----------------------*/


Route::get('date', function () {

    $start = Carbon::parse('2024-03-01');
    $end = Carbon::parse('2024-03-31');
    $interval = $end->diffInDays($start);

    $dates = [];
    for ($i = 0; $i <= $interval; $i++) {
        $dates[] = $start->copy()->addDays($i);
    }
    $weeks = [];
    foreach ($dates as $date) {
        $weekNumber = $date->weekOfYear;
        if (!isset($weeks[$weekNumber])) {
            $weeks[$weekNumber] = [];
        }
        $weeks[$weekNumber][] = $date;
    }

    // return $dates;
    return $weeks;
});

Route::get('date/v2', function () {
    $start_date = Carbon::parse('2024-03-01');
    $end_date = Carbon::parse('2024-03-31');

    // Calculate the total days
    $total_days = $end_date->diffInDays($start_date) + 1;

    // Calculate the total weeks
    $total_weeks = ceil($total_days / 7);

    // Create an array to store the weeks and days
    $weeks = [];

    // Loop through each week
    for ($i = 0; $i < $total_weeks; $i++) {
        $week_start = $start_date->copy()->addDays($i * 7)->startOfWeek();
        $week_end = $week_start->copy()->endOfWeek();
        $weeks[] = [
            'week_start' => $week_start->toDateString(),
            'week_end' => $week_end->toDateString(),
            'days' => $week_start->diffInDays($week_end) + 1
        ];
    }

    // Output the weeks and days
    foreach ($weeks as $week) {
        echo "Week: {$week['week_start']} - {$week['week_end']} ({$week['days']} days)\n";
    }
});

Route::get('date/v3', function () {

    $start_date = Carbon::parse('2024-03-01');
    $end_date = Carbon::parse('2024-03-28');

    $days = [];
    $weeks = [];

    $current_date = $start_date->copy();
    // return $current_date->format('Y-m-d l');
    // return $current_date->copy()->startOfMonth()->weekOfMonth;
    while ($current_date <= $end_date) {
        $day_number = $current_date->dayOfWeek; // 0 (Sunday) to 6 (Saturday)
        if ($day_number >= 0 && $day_number <= 4) {
            $days[] = $current_date->format('Y-m-d l'); // Add day to the list if it's Sunday to Thursday
        }

        if ($current_date->weekOfMonth != $current_date->copy()->startOfMonth()->weekOfMonth) {
            // If the week has changed from the previous day, add the week number
            $weeks[] = $current_date->weekOfMonth;
        }
        $current_date->addDay(); // Move to the next day
    }

    // Output the results
    echo "Days from Sunday to Thursday:\n";
    echo "<br>";
    foreach ($days as $day) {
        echo $day . "\n";
        echo "<br>";
    }

    echo "\nWeeks during the period:\n";
    echo "<br>";
    foreach ($weeks as $week) {
        echo "Week " . $week . "\n";
        echo "<br>";
    }
});

Route::get('date/v4', function () {
    // Assuming $startDate and $endDate are your study start and end dates
    // $startDate = Carbon::parse($startDate);
    // $endDate = Carbon::parse($endDate);

    function getDaysFromSundayToThursdays($startDate, $endDate)
    {
        $days = [];
        $weeks = [];
        $months = [];
        $years = [];
        // Loop through each day between the start and end dates
        for ($date = $startDate; $date->lte($endDate); $date->addDay()) {
            // Check if the current day is Sunday to Thursday (0 = Sunday, 4 = Thursday)
            if ($date->dayOfWeek >= 0 && $date->dayOfWeek <= 4) {
                $days[] =  $date->dayOfWeek;
                $weeks[] = $date->weekOfMonth;
                $months[] = $date->month;
                $years[] = $date->year;
            }
        }
        return [
            'days' => $days,
            'weeks' => $weeks,
            'months' => $months,
            'years' => $years
        ];
    }

    
    $startDate = Carbon::parse('2023-12-08');
    $endDate = Carbon::parse('2024-02-13');
    $data = getDaysFromSundayToThursdays($startDate, $endDate);

    return $data['years'];

    $days = [];
    $weeks = [];
    $months = [];
    $years = [];

    // Loop through each day between the start and end dates
    for ($date = $startDate; $date->lte($endDate); $date->addDay()) {
        // Check if the current day is Sunday to Thursday (0 = Sunday, 4 = Thursday)
        if ($date->dayOfWeek >= 0 && $date->dayOfWeek <= 4) {
            $days[] =  $date->dayOfWeek;
            $weeks[] = $date->weekOfMonth;
            $months[] = $date->month;
            $years[] = $date->year;
        }


        // return $date->weekOfMonth;

        // if ($date->weekOfMonth != $date->copy()->startOfMonth()->weekOfMonth) {
        //     // If the week has changed from the previous day, add the week number
        //     $weeks[] = $date->weekOfMonth;
        // }
    }
    // if ($current_date->weekOfMonth != $current_date->copy()->startOfMonth()->weekOfMonth) {
    //     // If the week has changed from the previous day, add the week number
    //     $weeks[] = $current_date->weekOfMonth;
    // }

    // return $months;
    // echo "<br>";
    return [$days, $weeks, $months, $years];

    // foreach ($days as $key => $day) {
    //     echo $day+1 . " --- ".$weeks[$key]." --- ".$months[$key]." --- ".$years[$key];
    //     echo "<br>";
    // }
    echo "------------------------";
    // echo "\nWeeks during the period:\n";
    // echo "<br>";
    // // foreach ($weeks as $week) {
    // //     echo "Week " . $week . "\n";
    // //     echo "<br>";
    // // }
});


Route::get('date/v5', function () {

    function getDaysFromSundayToThursday($startDate, $endDate)
    {
        $startDate = Carbon::parse($startDate);
        $endDate = Carbon::parse($endDate);
        $days = new Collection();

        while ($startDate->lte($endDate)) {
            if ($startDate->isWeekday() && $startDate->dayOfWeek >= Carbon::SUNDAY && $startDate->dayOfWeek <= Carbon::THURSDAY) {
                $days->push($startDate->copy());
            }
            $startDate->addDay();
        }

        return $days->groupBy(function ($day) {
            return $day->format('F Y');
        });
    }

    // Example usage
    $startDate = '2024-04-01';
    $endDate = '2024-05-31';
    $days = getDaysFromSundayToThursday($startDate, $endDate);

    // Output the result
    $days->each(function ($group, $month) {
        echo "$month:\n";
        $group->each(function ($day) {
            echo "- {$day->format('l, jS F Y')}\n" . "<br>";
        });
        echo "\n";
    });
});
