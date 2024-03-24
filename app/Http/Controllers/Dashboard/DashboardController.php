<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Admin\AdminRepository;
use App\Repositories\Student\StudentRepository;
use App\Repositories\Subject\SubjectRepository;
use App\Repositories\Teacher\TeacherRepository;

class DashboardController extends Controller
{
    private $admins;
    private $teachers;
    private $students;
    private $subjects;

    /**
     * DashboardController constructor.
     * @param AdminRepository $admins
     * @param TeacherRepository $teachers
     * @param StudentRepository $students
     * @param SubjectRepository $subjects
     */
    public function __construct(AdminRepository $admins,TeacherRepository $teachers,StudentRepository $students , SubjectRepository $subjects)
    {
        $this->admins = $admins;
        $this->teachers = $teachers;
        $this->students = $students;
        $this->subjects = $subjects;
    }   
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $admins = $this->admins->all();
        $teachers = $this->teachers->all() ;
        $students = $this->students->all();
        $subjects = $this->subjects->all();

        // dd(count($this->admins->all()));
        return view('dashboard.index',compact('admins','teachers','students','subjects'));
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
        //
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
