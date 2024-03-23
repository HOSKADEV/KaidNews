@extends('layouts/contentNavbarLayout')

@section('title', trans('evaluation.create'))

@section('page-script')
    <script src="{{ asset('assets/js/pages-account-settings-account.js') }}"></script>
@endsection

@section('content')

    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">{{ trans('evaluation.dashboard') }}/{{ trans('evaluation.evaluations') }}/</span>
        {{ trans('evaluation.create') }}
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
        <div class="row">
            <div class="table-responsive text-nowrap pb-4">
                <form action="{{ route('dashboard.evaluations.store') }}" method="POST">
                    @csrf
                    @method('POST')
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
                                        <input type="number" name="rate[]" class="form-control rate">
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <button type="submit" class="btn btn-primary mx-4">{{ trans('app.save') }}</button>
                </form>
            </div>
        </div>
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
