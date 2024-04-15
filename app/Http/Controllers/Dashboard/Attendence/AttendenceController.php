<?php

namespace App\Http\Controllers\Dashboard\Attendence;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Student\StudentRepository;
use App\Repositories\Attendence\AttendenceRepository;

class AttendenceController extends Controller
{
    private $students;
    private $attendences;

    /**
     * AttendenceController constructor.
     * @param StudentRepository $students
     * @param AttendenceRepository $attendence
     */
    public function __construct(StudentRepository $students, AttendenceRepository $attendences)
    {
        $this->students = $students;
        $this->attendences = $attendences;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // if($request->has('year') != null){
        //     $now = Carbon::parse(now());
        //     // $year = $now->year;
        // }
        $now = Carbon::parse(now());


        $week = $request->week == null ? $now->weekOfMonth : $request->week;
        $month = $request->month == null ? $now->month  : $request->month;
        $year = $request->year == null ? $now->year  : $request->year;
        // $group = $request->group == null ? null : $request->group;
        //         $students = $this->students->paginate($perPage = 10, $request->search, $request->registration_number,$request->batch, $request->group);

        $students = $this->students->paginate($perPage = 10, $request->searchFrom, $request->searchTo, $request->search, $request->registration_number, $request->batch, $request->group);
        return view('dashboard.attendence.index', compact('students', 'year', 'month', 'week'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $student = Student::findOrfail($request->student);
        $student = $this->students->find($request->student);
        $attendence = $this->attendences->findAttendence($request->student, $request->year, $request->month, $request->week, $request->day);
        if ($request->isChecked == 'true') {
            $data = [
                // 'day' => $request->day,
                // 'month' => $request->month,
                // 'student_id' => $request->student,
                // 'week' => $request->week,
                // 'year' => $request->year,
                'number' => $attendence->number + 1,
            ];
            $this->attendences->update($attendence->id, $data);
            // $this->attendences->create($data);
            return response()->json(['success' => trans('attendence.attendance') . " " . $student->name . " " . trans('attendence.day') . " " . trans('attendence.days.' . $request->day)]);
        } else {
            $data = [
                // 'day' => $request->day,
                // 'month' => $request->month,
                // 'student_id' => $request->student,
                // 'week' => $request->week,
                // 'year' => $request->year,
                'number' => $attendence->number - 1,
            ];
            $this->attendences->update($attendence->id, $data);
            // $this->attendences->deleteAttendence($request->student, $request->day, $request->week, $request->month, $request->year);
            return response()->json(['success' => trans('attendence.absence') . " " . $student->name . " " . trans('attendence.day') . " " . trans('attendence.days.' . $request->day)]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
