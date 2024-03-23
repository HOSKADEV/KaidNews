<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Repositories\Student\StudentRepository;
use App\Http\Requests\Auth\RegisterStudentRequest;

class RegisterController extends Controller
{
    private $students;

    /**
     * RegisterController constructor.
     * @param StudentRepository $students
     */
    public function __construct(StudentRepository $students)
    {
        $this->students = $students;
    }
    
    public function registerForm()
    {
        return view('auth.student.register');
    }

    public function register(RegisterStudentRequest $request)
    {
        $student = $this->students->create($request->all());

        auth()->guard('student')->login($student);

        // return to_route('dashboard.student');
        return redirect()->intended(RouteServiceProvider::STUDENT);
    }
}
