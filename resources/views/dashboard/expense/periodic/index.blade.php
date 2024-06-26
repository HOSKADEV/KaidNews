@extends('layouts/contentNavbarLayout')

@section('title', trans('expense.title'))

@section('content')
  <div class="card">
    <div class="card-body">
      <div>
        <a class="btn btn-primary" href="javascript:void(0);" data-bs-toggle="modal"
            data-bs-target="#addPeriodicModal">
            <i class='bx bx-list-plus me-2' ></i>
            {{ trans('expense.Add periodic expenses') }}
        </a>
        @include('dashboard.expense.periodic.add')
      </div>
    </div>
  </div>
  <div class="card mt-3">
    <div class="card-body">
      <form action="" method="GET" id="filterEmployeeForm">
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
                @if (count($periodics))
                    <button target="_blank" id="printSection"
                        data-url="{{ route('dashboard.print.periodic', [
                            'month' => Request::get('month'),
                            'year' => Request::get('year'),
                        ]) }}"
                        class="btn btn-primary text-white">
                        <span class="bx bxs-printer"></span>&nbsp; {{ trans('app.print') }}
                    </button>
                @endif
            </div>
        </div>
      </form>

      <div class="mt-5">
        <div class="table-responsive text-nowrap">
          <table class="table mb-2">
            <thead>
                <tr class="text-nowrap">
                    <th></th>
                    <th>{{ trans('expense.periodic') }}</th>
                    <th>{{ trans('expense.Outflows') }}</th>
                    <th>{{ trans('expense.Notes') }}</th>
                    <th>{{ trans('app.actions') }}</th>
                </tr>
            </thead>
            <tbody>
              @php
                $total = 0;
              @endphp
              @if (count($periodics))
              <tr>
                <td rowspan="{{ count($periodics) }}">{{ trans('expense.Periodic expenses') }}</td>
                @foreach ($periodics as $periodic)
                  @php
                    $total += $periodic->amount;
                  @endphp
                    <td>{{ $periodic->typeExpenses->name }}</td>
                    <td>{{ number_format($periodic->amount,2,'.',','). ' دج' }}</td>
                    <td>{{ $periodic->notes }}</td>
                    <td>
                      <div class="dropdown">
                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                            data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i>
                        </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal"
                                data-bs-target="#editPeriodicModal{{ $periodic->id }}">
                                <i class="bx bx-edit-alt me-2"></i>
                                {{ trans('expense.edit') }}
                            </a>
                            <a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal"
                                data-bs-target="#deletePeriodicModal{{ $periodic->id }}">
                                <i class="bx bx-trash me-2"></i>
                                {{ trans('expense.deleted') }}
                            </a>
                        </div>
                    </div>
                    </td>
                  </tr>
                  @include('dashboard.expense.periodic.edit')
                  @include('dashboard.expense.periodic.delete')
                @endforeach
                <tr>
                  <td></td>
                  <td colspan="1">{{  trans('expense.Total periodic expenses') }}</td>
                  <td>{{ number_format($total,2,'.',','). ' دج'  }}</td>
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
          $("#filterEmployeeForm").submit();
      }
      $("#printSection").click(function(e) {
          let url = $(this).attr('data-url');
          var printWindow = window.open(url, '_blank', 'height=auto,width=auto');
          printWindow.print();
      });

    });
  </script>
@endsection


