<?php

namespace App\Http\Controllers\Student;

use App\Models\Evaluation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Student\StudentRepository;

class StudentDashboardController extends Controller
{
    private $students;

    /**
     * StudentDashboardController constructor.
     * @param StudentRepository $students
     */
    public function __construct(StudentRepository $students)
    {
        $this->students = $students;
    }
    public function index(){

        $account = $this->students->findNotes(auth('student')->id());
        $evaluationExists = Evaluation::whereStudentId(auth('student')->id())->first();
        return view('student-dashboard.index',compact('account','evaluationExists'));
    }

    public function indexAdmin($id){

      $account = $this->students->findNotes($id);
      $evaluationExists = Evaluation::whereStudentId($id)->first();
      return view('student-dashboard.index',compact('account','evaluationExists'));
  }

    public function account(){
        $student = $this->students->find(auth('student')->id());
        return view('student-dashboard.profile',compact('student'));
    }
}
