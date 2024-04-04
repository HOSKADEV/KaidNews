<?php

namespace App\Http\Controllers\Dashboard\Note;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Note\NoteRepository;

class NoteController extends Controller
{
    private $notes;

    /**
     * NoteController constructor.
     * @param NoteRepository $notes
     */
    
    public function __construct(NoteRepository $notes)
    {
        $this->notes = $notes;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        // dd($request);
        $this->notes->create([
            'student_id' => auth('student')->id(),
            'start_date' => auth('student')->user()->start_date,
            'end_date' => auth('student')->user()->end_date,
            'note' => $request->note
        ]);
        toastr()->success(trans('message.success.create'));
        return redirect()->back();
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
