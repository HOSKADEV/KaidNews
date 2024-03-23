<?php

namespace App\Http\Controllers\Dashboard\Evaluation;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Student\StudentRepository;
use App\Repositories\Subject\SubjectRepository;
use App\Repositories\Evaluation\EvaluationRepository;

class EvaluationController extends Controller
{
    private $students;
    private $subjects;
    private $evaluations;

    /**
     * EvaluationController constructor.
     * @param StudentRepository $students
     * @param SubjectRepository $subjects
     * @param EvaluationRepository $evaluations
     */
    public function __construct(StudentRepository $students, SubjectRepository $subjects, EvaluationRepository $evaluations)
    {
        $this->students = $students;
        $this->subjects = $subjects;
        $this->evaluations = $evaluations;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $students = $this->students->paginate($perPage = 10, $request->search);
        return view('dashboard.evaluation.index', compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id = null)
    {
        $student = $this->students->find($id);
        $subjects = $this->subjects->all();
        return view('dashboard.evaluation.create', compact('student', 'subjects'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = [];
        for ($item = 0; $item < count($request->rate); $item++) {
            $data = [
                'student_id' =>$request->student_id[$item],
                'subject_id' => $request->subject_id[$item],
                'rate' => $request->rate[$item],
            ];
            $this->evaluations->create($data);
        }
        toastr()->success(trans('message.success.create'));
        return redirect()->route('dashboard.evaluations.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $student = $this->students->find($id);
        return view('dashboard.evaluation.single', compact('student'));

        // findNotes
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
