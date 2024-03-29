<?php

namespace App\Http\Controllers\Auth;

use Carbon\Carbon;
use App\Traits\DaysTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Repositories\Student\StudentRepository;
use App\Http\Requests\Auth\RegisterStudentRequest;
use App\Repositories\Attendence\AttendenceRepository;

class RegisterController extends Controller
{
    use DaysTrait;
    private $students;
    private $attendences;

    /**
     * RegisterController constructor.
     * @param StudentRepository $students
     * @param AttendenceRepository $attendences
     */
    public function __construct(StudentRepository $students, AttendenceRepository $attendences)
    {
        $this->students = $students;
        $this->attendences = $attendences;
    }

    public function registerForm()
    {
        return view('auth.student.register');
    }

    public function register(RegisterStudentRequest $request)
    {
        // dd($request->all());
        $student = $this->students->create($request->all());

        $startDate = Carbon::parse($student->start_date);
        $endDate = Carbon::parse($student->end_date);
        // $allDays = $this->getDaysFromSundayToThursdays(, );
        $allDays = $this->getDaysFromSundayToThursdays($startDate, $endDate);

        foreach ($allDays['days'] as $key => $day) {
            $data = [
                'day' => $day+1,
                'week' =>$allDays['weeks'][$key],
                'month' =>$allDays['months'][$key],
                'year' =>$allDays['years'][$key],
                'student_id' => $student->id,
                'number' => 3,
            ];
            $this->attendences->create($data);
        }
        auth()->guard('student')->login($student);
        return redirect()->intended(RouteServiceProvider::STUDENT);
    }
}
