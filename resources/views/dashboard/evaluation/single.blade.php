@extends('layouts/contentNavbarLayout')

@section('title', trans('evaluation.title_student'))

@section('page-script')
    <script src="{{ asset('assets/js/pages-account-settings-account.js') }}"></script>
@endsection

@section('content')
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">{{ trans('evaluation.dashboard') }}/{{ trans('evaluation.evaluations') }}/</span> {{ trans('evaluation.title_student') }}
    </h4>
    <div class="card">
        <div class="card-body">
            {{-- date_stage --}}
            <label for="" class="form-label">{{ trans('evaluation.date_stage') }} : 2023/04/05</label> <br>
            <label for="" class="form-label">{{ trans('evaluation.first_name_last_name') }} : {{ $student->name }}</label> <br>
            <label for="" class="form-label">{{ trans('evaluation.birthday_state_of_birth') }} : {{ $student->birthday }} {{ $student->state_of_birth }}</label>
        </div>
        <div class="row px-4 pb-3">
          <div class="form-group col-md-3" dir="{{ config('app.locale') == 'ar' ? 'rtl' : 'ltr' }}">
              <label for="rank" class="form-label">{{ trans('evaluation.label.rank') }}</label>
              @if (!empty($evaluationExists))
                @switch($evaluationExists->rank)
                  @case(0)
                    <input type="text" class="form-control" value="{{ trans('app.Norank') }}" disabled>
                    @break
                  @case(1)
                    <input type="text" class="form-control" value="{{ trans('evaluation.select.rank1') }}" disabled>
                    @break
                  @case(2)
                    <input type="text" class="form-control" value="{{ trans('evaluation.select.rank2') }}" disabled>
                    @break
                  @case(3)
                    <input type="text" class="form-control" value="{{ trans('evaluation.select.rank3') }}" disabled>
                    @break
                  @default
                    <input type="text" class="form-control" value="{{ trans('app.Norank') }}" disabled>
                @endswitch
              @else
                <input type="text" class="form-control" value="{{ trans('app.Norank') }}" disabled>
              @endif
          </div>
          <div class="form-group col-md-3" dir="{{ config('app.locale') == 'ar' ? 'rtl' : 'ltr' }}">
              <label for="golden_passport" class="form-label">{{ trans('evaluation.label.golden_passport') }}</label>
              @if (!empty($evaluationExists))
                @switch($evaluationExists->golden_passport)
                  @case(0)
                    <input type="text" class="form-control" value="{{ trans('evaluation.select.golden_passport_no') }}" disabled>
                    @break
                  @case(1)
                    <input type="text" class="form-control" value="{{ trans('evaluation.select.golden_passport_yes') }}" disabled>
                    @break
                  @default
                    <input type="text" class="form-control" value="{{ trans('evaluation.select.golden_passport_no') }}" disabled>
                @endswitch
              @endif
          </div>
        </div>
        <div class="table-responsive text-nowrap">
            <table class="table mb-2">
                <thead>
                    <tr class="text-nowrap">
                        <th>#</th>
                        <th>{{ trans('evaluation.subject_name') }}</th>
                        <th>{{ trans('subject.coef') }}</th>
                        <th>{{ trans('evaluation.rate') }}</th>
                        <th>{{ trans('evaluation.total_marks') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($student->tests as $key => $test)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $test->subject->name }}</td>
                            <td>{{ $test->subject->coef }}</td>
                            <td>{{ $test->rate }}</td>
                            <td>{{ $test->result }}</td>
                        </tr>
                    @endforeach
                    <tr>
                        <td></td>
                        <td>{{ trans('evaluation.total_coef') }}</td>
                        <td>{{ $student->total_coef }}</td>
                        <td></td>
                        <td>{{ $student->note }}</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>{{ trans('evaluation.moyen') }}</td>
                        <td>{{ number_format($student->moyen, 2) }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

@endsection
