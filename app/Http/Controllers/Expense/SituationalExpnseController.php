<?php

namespace App\Http\Controllers\Expense;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Repositories\TypesExpenses\TypesExpensesRepository;
use App\Repositories\SituationalExpnses\SituationalExpnsesRepository;

class SituationalExpnseController extends Controller
{
    private $TypesJobs;
    private $situational;

    public function __construct(TypesExpensesRepository $TypesJobs, SituationalExpnsesRepository $situational )
    {
        $this->TypesJobs = $TypesJobs;
        $this->situational = $situational;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $now = Carbon::parse(now());
        $month = $request->month == null ? $now->month  : $request->month;
        $year = $request->year == null ? $now->year  : $request->year;
        $jobs = $this->TypesJobs->byExpensesId(3);
        $situationals = $this->situational->paginate($perPage = 100, $month , $year);
        return view('dashboard.expense.situational.index', 
            compact('month', 'year', 'jobs', 'situationals'));
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
        $validata = Validator::make($request->all(), [
          'job'    => 'required',
          'newjob' => 'required_if:job,0',
          'amount'  => 'required',
          'month'  => 'required',
          'notes'   => 'sometimes'
        ]);

        if ($validata->fails())
        {
            toastr()->error($validata->errors()->first());
            return redirect()->back();
        }
        $date = now();

        if (!is_null($request->newjob)) {
          $dataNewJob = array_replace([
            'expenses_id' => 3,
            'name' => $request->newjob,
          ]);
          $newJob = $this->TypesJobs->create($dataNewJob);
        }
        
        $dataSituational = array_replace([
          'types_of_expenses_id' => $request->job == 0 ? $newJob->id : $request->job,
          'amount' => $request->amount,
          'notes' => $request->notes,
          'month' => $request->month,
          'year' => $date->format('Y'),
        ]);
        $situational = $this->situational->create($dataSituational);

        if ($situational) {
          toastr()->success('تمت الاضافة بنجاح');
          return redirect()->back();
        }
        else {
          toastr()->error('حدث خطأ ما');
          return redirect()->back();
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
        $validata = Validator::make($request->all(), [
          'job'    => 'required',
          'newjob' => 'required_if:job,0',
          'amount'  => 'required',
          'month'  => 'required',
          'notes'   => 'sometimes'
        ]);

        if ($validata->fails())
        {
            toastr()->error($validata->errors()->first());
            return redirect()->back();
        }

        $dataSituational = array_replace([
          'types_of_expenses_id' =>  $request->job,
          'amount' => $request->amount,
          'month' => $request->month,
          'notes' => $request->notes,
        ]);
        $situational = $this->situational->update($id, $dataSituational);

        if ($situational) {
          toastr()->success('تمت تحديث بنجاح');
          return redirect()->back();
        }
        else {
          toastr()->error('حدث خطأ ما');
          return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $situational = $this->situational->delete($id);
        if ($situational) {
          toastr()->success('تم الحذف بنجاح');
          return redirect()->back();
          } else {
            toastr()->error('لم يتم الحذف');
            return redirect()->back();
          }
    }
}
