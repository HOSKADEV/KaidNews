<?php

namespace App\Http\Controllers\Dashboard\Print;

use Carbon\Carbon;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;

use Illuminate\Support\Facades\Storage;

use App\Repositories\Student\StudentRepository;

class PrintController extends Controller
{
    private $students;

    /**
     * StudentController constructor.
     * @param StudentRepository $students
     */
    public function __construct(StudentRepository $students)
    {
        $this->students = $students;
    }

    public function attendence(Request $request)
    {

        $now = Carbon::parse(now());
        $year = $now->year;
        $month = $request->month == null ? $now->month  : $request->month;
        $group = $request->group;
        // $month = 3;
        // $group = $request->group == null ? null : $request->group;
        // $students = Student::with('attendences')->orWhere('group' ,$group)->get();
        // return view('dashboard.printer.attendence', compact('students', 'group','year', 'month','week'));

        // dd($group);
        if ($group != null) {
            $students = Student::with('attendences')
                ->where('group', $group)
                ->get();
        } else {
            $students = Student::with('attendences')->get();
        }

        return view('dashboard.printer.attendence', compact('students', 'group', 'year', 'month'));
    }


    public function trainee_notebook($student_id)
    {
    }

    public function students(Request $request)
    {
        $group = $request->group;
        $batch = $request->batch;

        $students = $this->students->listPrintStudent($request->search, $request->registration_number, $batch, $group);

        return view('dashboard.printer.students', compact('students', 'group', 'batch'));
    }

    public function teachers()
    {
        $teachers = Teacher::get();
        return view('dashboard.printer.teachers', compact('teachers'));
    }



    public function review($id)
    {
        $account = Student::with('tests', 'tests.subject')->find($id);

        return view('dashboard.printer.review', compact('account'));
    }
    public function certificate($id)
    {
        $account = Student::with('tests', 'tests.subject')->find($id);
        // return view('dashboard.printer.certificate', compact('account'));
        return view('dashboard.printer.index', compact('account'));

        // return redirect()->back();
    }


    public function studentModel()
    {
        $filePath = storage_path('app/public/student-model-file.xlsx');
        $newFilename = 'إستمارة معلومات المتربصين.xlsx';
        return Response::download($filePath, $newFilename);
    }
}
