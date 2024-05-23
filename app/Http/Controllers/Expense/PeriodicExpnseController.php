<?php

namespace App\Http\Controllers\Expense;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Repositories\TypesExpenses\TypesExpensesRepository;
use App\Repositories\PeriodicExpnses\PeriodicExpnsesRepository;

class PeriodicExpnseController extends Controller
{
    private $periodic;
    private $TypesJobs;

    public function __construct(TypesExpensesRepository $TypesJobs, PeriodicExpnsesRepository $periodic)
    {
        $this->TypesJobs = $TypesJobs;
        $this->periodic = $periodic;
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
        $jobs = $this->TypesJobs->byExpensesId(2);
        $periodics = $this->periodic->paginate($perPage = 100, $month, $year);

        return view('dashboard.expense.periodic.index', compact('periodics', 'jobs', 'month'));
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
      
        $dataPeriodic = array_replace([
          'types_of_expenses_id' => $request->job == 0 ? $newJob->id : $request->job,
          'amount' => $request->amount,
          'notes' => $request->notes,
          'month' => $request->month,
          'year' => $date->format('Y'),
        ]);

        $periodic = $this->periodic->create($dataPeriodic);

        if ($periodic) {
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

        $dataPeriodic = array_replace([
          'types_of_expenses_id' => $request->job,
          'amount' => $request->amount,
          'month' => $request->month,
          'notes' => $request->notes,
        ]);
      
      $periodic = $this->periodic->update($id, $dataPeriodic);

      if ($periodic) {
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
        $periodic = $this->periodic->delete($id);
        if ($periodic) {
          toastr()->success('تم الحذف بنجاح');
          return redirect()->back();
          } else {
            toastr()->error('لم يتم الحذف');
            return redirect()->back();
          }
    }
}
