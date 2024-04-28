<?php

namespace App\Http\Controllers\Dashboard\Certificate;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Repositories\Student\StudentRepository;
use App\Repositories\Certificate\CertificateRepository;

class CertificateController extends Controller
{
    private $students;
    private $sertificates;

    /**
     * StudentController constructor.
     * @param StudentRepository $students
     * @param CertificateRepository $sertificates
     */

    public function __construct(StudentRepository $students,CertificateRepository $sertificates)
    {
        $this->students = $students;
        $this->sertificates = $sertificates;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $students = $this->students->paginate($request->perPage ? $request->perPage : PAGINATE_COUNT,
                                    $request->year ,
                                    $request->start_date,
                                    $request->end_date ,
                                    $request->search,
                                    $request->registration_number,
                                    $request->batch,
                                    $request->group,$request->rank,
                                    $request->passport,
                                    $request->status);

        $listStduents = $this->students->listStudentHasNotCertificate();
        return view('dashboard.certificate.index',compact('students','listStduents'));
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
        $fileName = time().'.'.$request->certificate->extension();

        // dd( $fileName);
        // $request->certificate->move(storage_path('uploads/sertificates'), $fileName);
        // $request->file->move(public_path('uploads'), $fileName);

        // Storage::put("uploads/sertificates/",  $fileName);
        // Storage::append('uploads/sertificates/file.log', 'Appended Text');


        // Storage::put("uploads/sertificates", $fileName);
        // dd($request->all());

        // Storage::disk('uploads')->put($fileName, 'uploads/sertificates/');
        Storage::disk('uploads')->put($fileName,'uploads');
        // $request->certificate->move(storage_path('uploads/sertificates/'), $fileName);
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
