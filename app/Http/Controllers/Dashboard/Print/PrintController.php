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
        // dd($request->all());
        $now = Carbon::parse(now());
        $date = Carbon::now()->year;
        $year  = $now->year;
        $month = $request->month == null ? $now->month  : $request->month;
        $week  = $request->week;
        $registration_number = $request->registration_number;
        $search = $request->search;
        $batch  = $request->batch;
        $rank   = $request->rank;
        $passport = $request->passport;
        $start_date = $request->start_date;
        $end_date = $request->end_date;
        // $month = 3;
        $group = $request->group == null ? null : $request->group;
        // dd($group);
        $students = $this->students->paginate($request->perPage ? $request->perPage : PAGINATE_COUNT, $year,$request->start_date,$request->end_date, $request->search, $request->registration_number,$request->batch, $request->group,$request->rank,$request->passport);
        return view('dashboard.printer.attendence', compact('students', 'group', 'year', 'month','date'));

        // dd($students);
        // $students = Student::with('attendences')->orWhere('group' ,$group)->get();
        // dd($group);
        // if ($group != null) {
        //     $students = Student::with('attendences')
        //         ->where('group', $group)
        //         ->get();
        // } else {
        //     $students = Student::with('attendences')->get();
        // }

    }


    public function trainee_notebook($student_id)
    {
    }

    public function students(Request $request)
    {
        $date = Carbon::now()->year;
        $group = $request->group;
        $batch = $request->batch;

        $students = $this->students->paginate($request->perPage ? $request->perPage : PAGINATE_COUNT, $request->year,$request->start_date,$request->end_date, $request->search, $request->registration_number,$request->batch, $request->group,$request->rank,$request->passport);

        // $students = $this->students->listPrintStudent($request->search, $request->registration_number, $batch, $group);

        return view('dashboard.printer.students', compact('students', 'group', 'batch','date'));
    }

    public function teachers()
    {
        $teachers = Teacher::get();
        return view('dashboard.printer.teachers', compact('teachers'));
    }



    public function review(Request $request)
    {
        $date = Carbon::now()->year;
        $group = $request->group;
        $batch = $request->batch;
        $students = $this->students->paginate($request->perPage ? $request->perPage : PAGINATE_COUNT, $request->year,$request->start_date,$request->end_date, $request->search, $request->registration_number,$request->batch, $request->group,$request->rank,$request->passport);

        return view('dashboard.printer.reviews-list', compact('students', 'group', 'batch','date'));
    }
    public function certificate(Request $request)
    {
      $date = Carbon::now()->year;
      $group = $request->group;
      $batch = $request->batch;
      $students = $this->students->paginate($request->perPage ? $request->perPage : PAGINATE_COUNT, $request->year,$request->start_date,$request->end_date, $request->search, $request->registration_number,$request->batch, $request->group,$request->rank,$request->passport);
        // return view('dashboard.printer.certificate', compact('account'));
        return view('dashboard.printer.certificate-list', compact('students', 'group', 'batch','date'));

        // return redirect()->back();
    }


    public function studentModel()
    {
        $date = Carbon::now()->year;
        $filePath = storage_path('app/public/student-model-file.xlsx');
        $newFilename = 'إستمارة معلومات المتربصين.xlsx';
        return Response::download($filePath, $newFilename);
    }
}
