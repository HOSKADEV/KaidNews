<?php

namespace App\Http\Controllers\Dashboard\Print;

use Carbon\Carbon;
use App\Models\Student;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Teacher;

class PrintController extends Controller
{
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

        if ($group != null) {
            $students = Student::where('group', $group)
                ->get();
        } else {
            $students = Student::get();
        }
        return view('dashboard.printer.students', compact('students', 'group'));
    }

    public function teachers(){
        $teachers = Teacher::get();
        return view('dashboard.printer.teachers', compact('teachers'));

    }
}
