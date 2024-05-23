<?php

namespace App\Http\Controllers\Expense;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\EmployeeExpnses\EmployeeExpnsesRepository;
use App\Repositories\PeriodicExpnses\PeriodicExpnsesRepository;
use App\Repositories\SituationalExpnses\SituationalExpnsesRepository;

class ExpenseController extends Controller
{
    private $employee;
    private $periodic;
    private $situational;

    public function __construct(
        SituationalExpnsesRepository $situational,
        PeriodicExpnsesRepository $periodic,
        EmployeeExpnsesRepository $employee)
    {
        $this->situational = $situational;
        $this->periodic = $periodic;
        $this->employee = $employee;
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
        $employees = $this->employee->paginate($perPage = 100, $month , $year);
        $periodics = $this->periodic->paginate($perPage = 100, $month, $year);
        $situationals = $this->situational->paginate($perPage = 100, $month , $year);

        return view('dashboard.expense.index', compact('month', 'employees', 'periodics', 'situationals'));
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
