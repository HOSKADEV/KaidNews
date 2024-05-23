<?php

namespace App\Http\Controllers\Expense;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Repositories\TypesExpenses\TypesExpensesRepository;
use App\Repositories\EmployeeExpnses\EmployeeExpnsesRepository;

class EmployeeExpnseController extends Controller
{
    private $TypesJobs;
    private $employeeExpnses;

    public function __construct(TypesExpensesRepository $TypesJobs, EmployeeExpnsesRepository $employeeExpnses)
    {
        $this->TypesJobs = $TypesJobs;
        $this->employeeExpnses = $employeeExpnses;
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
        $jobs = $this->TypesJobs->byExpensesId(1);
        $employees = $this->employeeExpnses->paginate($perPage = 100, $month , $year);
        
        return view('dashboard.expense.employee.index',
        compact('month', 'year', 'jobs','employees'));
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
          'name'    => 'required|string',
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
              'expenses_id' => 1,
              'name' => $request->newjob,
            ]);
            $newJob = $this->TypesJobs->create($dataNewJob);
        }

        $dataEmployee = array_replace([
          'types_of_expenses_id' => $request->job == 0 ? $newJob->id : $request->job,
          'name' => $request->name,
          'amount' => $request->amount,
          'notes' => $request->notes,
          'month' => $request->month,
          'year' => $date->format('Y'),
        ]);
        $employee = $this->employeeExpnses->create($dataEmployee);

        if ($employee) {
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
          'newjob'  => 'required_if:job,0',
          'name'    => 'required|string',
          'amount'  => 'required',
          'month'  => 'required',
          'notes'   => 'sometimes'
        ]);

        if ($validata->fails())
        {
            toastr()->error($validata->errors()->first());
            return redirect()->back();
        }

        $dataEmployee = array_replace([
          'types_of_expenses_id' => $request->job,
          'name' => $request->name,
          'amount' => $request->amount,
          'month' => $request->month,
          'notes' => $request->notes,
        ]);
        $employee = $this->employeeExpnses->update($id, $dataEmployee);

        if ($employee) {
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
        $employee = $this->employeeExpnses->delete($id);
        if ($employee) {
          toastr()->success('تم الحذف بنجاح');
          return redirect()->back();
          } else {
            toastr()->error('لم يتم الحذف');
            return redirect()->back();
          }
    }
}
