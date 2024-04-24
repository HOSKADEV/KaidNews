@extends('layouts/contentNavbarLayout')

@section('title', trans('evaluation.edit'))

@section('page-script')
    <script src="{{ asset('assets/js/pages-account-settings-account.js') }}"></script>
@endsection

@section('content')

    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">{{ trans('evaluation.dashboard') }}/{{ trans('evaluation.evaluations') }}/</span>
        {{ trans('evaluation.edit') }}
    </h4>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ trans('evaluation.student_information') }} :</h5>
            <div class="row">
                <div class="col-sm-12 col-md-5">
                    <h6>{{ trans('evaluation.first_name_last_name') }} : {{ $student->name }}</h6>
                </div>
                <div class="col-sm-12 col-md-5">
                    <h6>{{ trans('evaluation.registration_number') }} : {{ $student->registration_number }}</h6>
                </div>
                <div class="col-sm-12 col-md-2">
                    <h6>{{ trans('evaluation.group') }} : {{ $student->group }}</h6>
                </div>
            </div>
        </div>
        <hr class="my-0">
        <form action="{{ route('dashboard.evaluations.update', 'update') }}" method="POST">
            @csrf
            @method('PUT')
            <input type="text" name="student" value="{{ $student->id }}">
            <div class="table-responsive text-nowrap pb-2">
                <table class="table mb-4 repeater">
                    <thead>
                        <tr class="text-nowrap">
                            <th>#</th>
                            <th>{{ trans('evaluation.subject_name') }}</th>
                            <th>{{ trans('subject.coef') }}</th>
                            <th>{{ trans('evaluation.rate') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($subjects as $item => $subject)
                            <tr class="subject">
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $subject->name }}</td>
                                <td>{{ $subject->coef }}</td>
                                <td>
                                    <input type="hidden" name="student_id[]" value="{{ $student->id }}">
                                    <input type="hidden" name="subject_id[]" value="{{ $subject->id }}">
                                    @foreach ($evaluations as $evaluation )
                                      @if ($subject->id == $evaluation->subject_id)
                                        <input type="number" name="rate[]" class="form-control rate" value="{{ $evaluation->rate }}">
                                      @endif
                                    @endforeach

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="row px-4">
                <div class="form-group col-md-3" dir="{{ config('app.locale') == 'ar' ? 'rtl' : 'ltr' }}">
                    <label for="rank" class="form-label">{{ trans('evaluation.label.rank') }}</label>
                    <select class="form-select" id="rank" name="rank" aria-label="Default select example">
                        <option value="">{{ trans('app.all') }}</option>
                        <option value="1">{{ trans('evaluation.select.rank1') }}</option>
                        <option value="2">{{ trans('evaluation.select.rank2') }}</option>
                        <option value="3">{{ trans('evaluation.select.rank3') }}</option>
                    </select>
                </div>
                <div class="form-group col-md-3" dir="{{ config('app.locale') == 'ar' ? 'rtl' : 'ltr' }}">
                    <label for="golden_passport" class="form-label">{{ trans('evaluation.label.golden_passport') }}</label>
                    <select class="form-select" id="golden_passport" name="golden_passport" aria-label="Default select example">
                        <option value="0">{{ trans('evaluation.select.golden_passport_no') }}</option>
                        <option value="1">{{ trans('evaluation.select.golden_passport_yes') }}</option>
                    </select>
                </div>

                {{-- <div class="form-group col-md-6" dir="{{ config('app.locale') == 'ar' ? 'rtl' : 'ltr' }}">
                    <label for="note" class="form-label">{{ trans('evaluation.label.note') }}</label>
                    <input type="text" name="note" class="form-control"
                        placeholder="{{ trans('evaluation.placeholder.note') }}">
                </div> --}}
            </div>

            <button type="submit" class="btn btn-primary mx-4 my-4">{{ trans('app.save') }}</button>
        </form>
    </div>

@endsection


@section('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            // $('.subject .rate').on('keyup', function(event) {
            //     // $(this).parents(':eq(1)');
            //     // var parent = $('.rate').parent();
            //     var parent = $('.rate').val();
            //     console.log(`parent `,parent );
            //     // console.log(`rate`,$('.subject .rate').val() );
            // })
            // console.log('Hello');
            // $('.subject tr .rate').on('change', function(event) {
            //     // console.log('rate');
            //     var tr = $(this).closest('tr');
            // })
            // $('.rate').on('change', function(event) {
            //     console.log(`rate : `, rate);
            // })
        });
    </script>
@endsection
