@extends('layouts/contentNavbarLayout')

@section('title', trans('expense.title'))

@section('content')
<div class="card mb-3">
  <div class="card-body">
    <a href="{{ route('dashboard.employee.index') }}" class="btn btn-outline-primary">{{ trans('expense.Add employee expenses') }}</a>
    <a href="{{ route('dashboard.periodic.index') }}" class="btn btn-outline-primary">{{ trans('expense.Add periodic expenses') }}</a>
    <a href="{{ route('dashboard.situational.index') }}" class="btn btn-outline-primary">{{ trans('expense.Add situational expenses') }}</a>
  </div>
</div>
<div class="card">
  <div class="card-body">
      <form action="" method="GET" id="filterForm">
        <div class="row ">
            <div class="form-group col-md-2 mb-2">
              <label for="month" class="form-label">{{ trans('attendence.label.month') }}</label>
              <select class="form-select" id="month" name="month" aria-label="Default select example">
                  @if ($month)
                      <option value="{{ $month }}"> {{ trans('attendence.months.' . $month) }}</option>
                  @else
                      <option value="">{{ trans('attendence.select.month') }}</option>
                  @endif
                  @for ($i = 1; $i <= 12; $i++)
                      <option value="{{ $i }}">{{ trans('attendence.months.' . $i) }}</option>
                  @endfor
              </select>
            </div>
            <div class="form-group col-md-2 mb-2">
              <label for="year" class="form-label">{{ trans('app.label.year') }}</label>
              <select class="form-select" id="year" name="year" aria-label="Default select example">
                  <option value="">{{ trans('app.select.year') }}</option>
                  @for ($i = $start_date; $i <= \Carbon\Carbon::now()->format('Y'); $i++)
                      <option value="{{ $i }}" {{ Request::get('year') == $i ? 'selected' : '' }}>
                          {{ trans('app.year') . ' ' . $i }}</option>
                  @endfor
              </select>
          </div>

            <div class="form-group col-md-2 mr-5 mt-4">
                @if (false)
                    <button target="_blank" id="printSection"
                        data-url="{{ route('dashboard.print.employee', [
                            'month' => Request::get('month'),
                            'year' => Request::get('year'),
                        ]) }}"
                        class="btn
                    btn-primary text-white">
                        <span class="bx bxs-printer"></span>&nbsp; {{ trans('app.print') }}
                    </button>
                @endif
            </div>
        </div>
      </form>
      {{-- ** Employee --}}
      <div class="my-3 mx-5 p-4">
        <div class="table-responsive text-nowrap">
          <table class="table mb-2">
            <thead>
                <tr class="text-nowrap">
                    <th>#</th>
                    <th>{{ trans('expense.Name Job') }}</th>
                    <th>{{ trans('expense.First Name & Last Name') }}</th>
                    <th>{{ trans('expense.Outflows') }}</th>
                    <th>{{ trans('expense.Notes') }}</th>
                </tr>
            </thead>
            <tbody>
              @php
                $totalE = 0;
              @endphp
              @if (count($employees))
                @foreach ($employees as $employee)
                  @php
                    $totalE += $employee->amount;
                  @endphp
                  <tr>
                    <td>{{ $loop->index +1 }}</td>
                    <td>{{ $employee->typeExpenses->name }}</td>
                    <td>{{ $employee->name }}</td>
                    <td>{{ number_format($employee->amount,2,'.',','). ' دج' }}</td>
                    <td>{{ $employee->notes }}</td>
                  </tr>
                @endforeach
                <tr>
                  <td></td>
                  <td colspan="2">{{  trans('expense.Total workers salaries') }}</td>
                  <td>{{ number_format($totalE,2,'.',','). ' دج'  }}</td>
                </tr>
              @else
                <tr>
                    <td colspan="6"><em>@lang('لا يوجد سجلات.')</em></td>
                </tr>
              @endif
            </tbody>
          </table>
          {{ $employees->links() }}
        </div>
      </div>
      {{-- ** Periodics--}}
      <div class="my-3 mx-5 p-4">
        <div class="table-responsive text-nowrap">
          <table class="table mb-2">
            <thead>
                <tr class="text-nowrap">
                    <th></th>
                    <th>{{ trans('expense.periodic') }}</th>
                    <th>{{ trans('expense.Outflows') }}</th>
                    <th>{{ trans('expense.Notes') }}</th>
                </tr>
            </thead>
            <tbody>
              @php
                $totalP = 0;
              @endphp
              @if (count($periodics))
              <tr>
                <td rowspan="{{ count($periodics) }}">{{ trans('expense.Periodic expenses') }}</td>
                @foreach ($periodics as $periodic)
                  @php
                    $totalP += $periodic->amount;
                  @endphp
                    <td>{{ $periodic->typeExpenses->name }}</td>
                    <td>{{ number_format($periodic->amount,2,'.',','). ' دج' }}</td>
                    <td>{{ $periodic->notes }}</td>
                  </tr>
                @endforeach
                <tr>
                  <td></td>
                  <td colspan="1">{{  trans('expense.Total periodic expenses') }}</td>
                  <td>{{ number_format($totalP,2,'.',','). ' دج'  }}</td>
                </tr>
              @else
                <tr>
                    <td colspan="6"><em>@lang('لا يوجد سجلات.')</em></td>
                </tr>
              @endif
            </tbody>
          </table>
          {{ $periodics->links() }}
        </div>
      </div>
      {{-- ** Situationals --}}
      <div class="my-3 mx-5 p-4">
        <div class="table-responsive text-nowrap">
          <table class="table mb-2">
            <thead>
                <tr class="text-nowrap">
                    <th></th>
                    <th>{{ trans('expense.situational') }}</th>
                    <th>{{ trans('expense.Outflows') }}</th>
                    <th>{{ trans('expense.Notes') }}</th>
                </tr>
            </thead>
            <tbody>
              @php
                $totalS = 0;
              @endphp
              @if (count($situationals))
              <tr>
                <td rowspan="{{ count($situationals) }}">{{ trans('expense.Situational expenses') }}</td>
                @foreach ($situationals as $situational)
                  @php
                    $totalS += $situational->amount;
                  @endphp
                    <td>{{ $situational->typeExpenses->name }}</td>
                    <td>{{ number_format($situational->amount,2,'.',','). ' دج' }}</td>
                    <td>{{ $situational->notes }}</td>
                  </tr>
                @endforeach
                <tr>
                  <td></td>
                  <td colspan="1">{{  trans('expense.Total situational expenses') }}</td>
                  <td>{{ number_format($totalS,2,'.',','). ' دج'  }}</td>
                </tr>
              @else
                <tr>
                    <td colspan="6"><em>@lang('لا يوجد سجلات.')</em></td>
                </tr>
              @endif
            </tbody>
          </table>
          {{ $situationals->links() }}
        </div>
      </div>
      {{-- ** Total --}}
      <div class="my-3 mx-5 p-4">
        <div class="table-responsive text-nowrap">
          <table class="table mb-2">
            @php
              $totalAll = 0;
              $totalAll = $totalE + $totalS + $totalP;
            @endphp
            <tr>
              <td colspan="1">{{  trans('expense.Total expenses') }}</td>
              <td>{{ number_format($totalAll,2,'.',','). ' دج'  }}</td>
            </tr>
          </table>
        </div>
      </div>
  </div>
</div>
@endsection

@section('js')
  <script>
    $(document).ready(function()
    {
      $.ajaxSetup({
          headers: {
              "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
          },
      });

      $('#job').on('change', function()
      {
        var job = $(this).val();
        var zeo = 0;
        if (job != zeo) {
          document.getElementById('newJobInput').style.display = 'none';
        } else {
          document.getElementById('newJobInput').style.display = 'block';
        }
      });

      $('#year').on('change', function(event) {
          timer = setTimeout(function() {
              submitForm();
          }, 1000);
      });

      $('#month').on('change', function(event) {
          timer = setTimeout(function() {
              submitForm();
          }, 1000);
      });

      function submitForm() {
          $("#filterForm").submit();
      }
      $("#printSection").click(function(e) {
          let url = $(this).attr('data-url');
          var printWindow = window.open(url, '_blank', 'height=auto,width=auto');
          printWindow.print();
      });

    });
  </script>
@endsection