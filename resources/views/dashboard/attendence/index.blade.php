@extends('layouts/contentNavbarLayout')

@section('title', trans('attendence.title'))

@section('page-script')
    <script src="{{ asset('assets/js/pages-account-settings-account.js') }}"></script>
    <script scr="http://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.2/js/toastr.min.js"></script>
@endsection

@section('content')
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">{{ trans('attendence.dashboard') }} /</span> {{ trans('attendence.attendence') }}
    </h4>
    <div class="card">
        <h5 class="card-header pt-0 mt-2">
            <form action="" method="GET" id="filterAttendenceForm">
                <div class="row">
                    <div class="form-group col-md-3 mb-2">
                        <label for="search" class="form-label">{{ trans('app.label.name') }}</label>
                        <input type="text" id="search" name="search" value="{{ Request::get('search') }}"
                            class="form-control input-solid"
                            placeholder="{{ Request::get('search') != '' ? '' : trans('app.placeholder.name') }}">
                    </div>
                    <div class="form-group col-md-3" dir="{{ config('app.locale') == 'ar' ? 'rtl' : 'ltr' }}">
                        <label for="registration_number"
                            class="form-label">{{ trans('app.label.registration_number') }}</label>
                        <input type="text" id="registration_number" name="registration_number"
                            value="{{ Request::get('registration_number') }}" class="form-control input-solid"
                            placeholder="{{ Request::get('registration_number') != '' ? '' : trans('app.placeholder.registration_number') }}">
                    </div>

                    <div class="form-group col-md-2 mb-2">
                        <label for="week" class="form-label">{{ trans('attendence.label.week') }}</label>
                        <select class="form-select" id="week" name="week" aria-label="Default select example">
                            @if ($week)
                                <option value="{{ $week }}"> {{ trans('attendence.weeks.' . $week) }}</option>
                            @else
                                <option value="">{{ trans('attendence.select.week') }}</option>
                            @endif
                            @for ($i = 1; $i <= 5; $i++)
                                <option value="{{ $i }}">{{ trans('attendence.weeks.' . $i) }}</option>
                            @endfor
                        </select>
                    </div>

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
                            <option value="">{{ trans('app.option.year_all') }}</option>
                            @for ($i = $start_date; $i <= \Carbon\Carbon::now()->format('Y'); $i++)
                                <option value="{{ $i }}" {{ Request::get('year') == $i ? 'selected' : '' }}>
                                    {{ trans('app.year') . ' ' . $i }}</option>
                            @endfor
                        </select>
                    </div>

                    <div class="form-group col-md-3 mb-2" dir="{{ config('app.locale') == 'ar' ? 'rtl' : 'ltr' }}">
                        <label for="group" class="form-label">{{ trans('student.label.group') }}</label>
                        <select class="form-select" id="group" name="group" aria-label="Default select example">
                            @if (Request::get('group') != null)
                                <option value="{{ Request::get('group') }}">
                                    {{ trans('app.groups.' . Request::get('group')) }}</option>
                            @else
                                <option value="">{{ trans('attendence.select.group') }}</option>
                            @endif
                            <option value="">{{ trans('app.all') }}</option>

                            @for ($group = 1; $group <= $groups; $group++)
                                <option value="{{ $group }}">{{ trans('app.groups.' . $group) }}</option>
                            @endfor
                        </select>
                    </div>

                    <div class="form-group col-md-3 mb-2" dir="{{ config('app.locale') == 'ar' ? 'rtl' : 'ltr' }}">
                        <label for="batch" class="form-label">{{ trans('student.label.batch') }}</label>
                        <select class="form-select" id="batch" name="batch" aria-label="Default select example">
                            @if (Request::get('batch') != null)
                                <option value="{{ Request::get('batch') }}">
                                    {{ trans('app.batchs.' . Request::get('batch')) }}</option>
                            @else
                                <option value="">{{ trans('app.select.batch') }}</option>
                            @endif
                            <option value="">{{ trans('app.all') }}</option>
                            <option value="1">{{ trans('app.batchs.1') }}</option>
                            <option value="2">{{ trans('app.batchs.2') }}</option>
                            <option value="3">{{ trans('app.batchs.3') }}</option>
                            <option value="4">{{ trans('app.batchs.4') }}</option>
                            <option value="5">{{ trans('app.batchs.5') }}</option>
                            <option value="6">{{ trans('app.batchs.6') }}</option>
                            <option value="7">{{ trans('app.batchs.7') }}</option>
                            <option value="8">{{ trans('app.batchs.8') }}</option>
                            <option value="9">{{ trans('app.batchs.9') }}</option>
                            <option value="10">{{ trans('app.batchs.10') }}</option>
                        </select>
                    </div>

                    <div class="form-group col-md-2 mb-2">
                        <label for="rank" class="form-label">{{ trans('app.label.rank') }}</label>
                        <select class="form-select" id="rank" name="rank" aria-label="Default select example">
                            <option value="">{{ trans('app.select.rank') }}</option>
                            <option value="all" {{ Request::get('rank') == 'all' ? 'selected' : '' }}>{{ trans('app.option.rank_all') }}</option>
                            <option value="1" {{ Request::get('rank') == 1 ? 'selected' : '' }}>
                                {{ trans('app.ranks.1') }}</option>
                            <option value="2"{{ Request::get('rank') == 2 ? 'selected' : '' }}>
                                {{ trans('app.ranks.2') }}</option>
                            <option value="3"{{ Request::get('rank') == 3 ? 'selected' : '' }}>
                                {{ trans('app.ranks.3') }}</option>
                        </select>
                    </div>

                    <div class="form-group col-md-2 mb-2">
                        <label for="passport" class="form-label">{{ trans('app.label.passport') }}</label>
                        <select class="form-select" id="passport" name="passport" aria-label="Default select example">
                            <option value="">{{ trans('app.select.passport') }}</option>
                            <option value="0" {{ Request::get('passport') == 0 ? 'selected' : '' }}>
                                {{ trans('app.no_passport') }}</option>
                            <option value="1"{{ Request::get('passport') == 1 ? 'selected' : '' }}>
                                {{ trans('app.have_passport') }}</option>

                        </select>
                    </div>


                    <div class="form-group col-md-3 mb-2" dir="{{ config('app.locale') == 'ar' ? 'rtl' : 'ltr' }}">
                        <label for="start_date" class="form-label">{{ trans('student.label.start_date') }}</label>
                        <input type="date" class="form-control input-solid" placeholder="YYYY-MM-DD"
                            style="background-color: #ffffff" name="start_date" id="start_date"
                            value="{{ Request::get('start_date') }}" />
                    </div>
                    <div class="form-group col-md-3" dir="{{ config('app.locale') == 'ar' ? 'rtl' : 'ltr' }}">
                        <label for="end_date" class="form-label">{{ trans('student.label.end_date') }}</label>
                        <input type="date" class="form-control input-solid" placeholder="YYYY-MM-DD"
                            style="background-color: #ffffff" name="end_date" id="end_date"
                            value="{{ Request::get('end_date') }}" />
                    </div>
                    <div class="form-group col-md-3 mb-2">
                        <label for="perPage" class="form-label">{{ trans('app.label.perPage') }}</label>
                        <select class="form-select" id="perPage" name="perPage" aria-label="Default select example">
                            <option value="">{{ trans('app.select.perPage') }}</option>
                            <option value="{{ $students->count() *$students->perPage() }}">{{ trans('app.all') }}</option>
                            <option value="10" {{ Request::get('perPage') == 10 ? 'selected' : '' }}>
                                10</option>
                            <option value="50"{{ Request::get('perPage') == 50 ? 'selected' : '' }}>
                                50</option>
                                <option value="100"{{ Request::get('perPage') == 100 ? 'selected' : '' }}>
                                    100</option>
                        </select>
                    </div>

                    <div class="form-group col-md-2 mr-5 mt-4 mb-2">
                        @if (count($students))
                            <button target="_blank" id="printSection"
                                data-url="{{ route('dashboard.print.attendence', [
                                    'search' => Request::get('search'),
                                    'registration_number' => Request::get('registration_number'),
                                    'week'  => Request::get('week'),
                                    'month' => Request::get('month'),
                                    'year'  => Request::get('year'),
                                    'group' => Request::get('group'),
                                    'batch' => Request::get('batch'),
                                    'rank'  => Request::get('rank'),
                                    'passport'   => Request::get('passport'),
                                    'start_date' => Request::get('start_date'),
                                    'end_date'   => Request::get('end_date'),
                                    'perPage'    => Request::get('perPage'),
                                ]) }}"
                                class="btn
                                btn-primary text-white">
                                <span class="bx bxs-printer"></span>&nbsp; {{ trans('app.print') }}
                            </button>
                        @endif
                    </div>

                </div>
            </form>
        </h5>
        <div class="table-responsive text-nowrap">
            <table class="table mb-2">
                <thead>
                    <tr class="text-nowrap">
                        <th>#</th>
                        <th>{{ trans('evaluation.name') }}</th>
                        <th>{{ trans('student.gender') }}</th>
                        <th>{{ trans('student.registration_number') }}</th>
                        <th>{{ trans('student.group') }}</th>
                        @for ($day = 1; $day <= $days; $day++)
                            <th> {{ trans('attendence.days.' . $day) }}</th>
                        @endfor
                    </tr>
                </thead>
                <tbody>
                    @if (count($students))
                        {{-- number --}}

                        @foreach ($students as $key => $student)
                            @php
                                $rowNumber = ($students->currentPage() - 1) * $students->perPage() + $loop->index + 1;
                            @endphp
                            <tr data-student="{{ $student->id }}" data-week="{{ $week }}"
                                data-month="{{ $month }}" data-year="{{ $year }}">
                                <th scope="row">{{ $rowNumber }}</th>
                                <td>{{ $student->name }}</td>
                                <td>{{ $student->gender == 1 ? trans('student.male') : trans('student.female') }}</td>
                                <td>{{ $student->registration_number }}</td>
                                <td>{{ trans('attendence.groups.' . $student->group) }}</td>


                                @for ($day = 1; $day <= $days; $day++)
                                    <td>
                                        @php
                                            $attendences = $student->attendences
                                                ->where('week', $week)
                                                ->where('month', $month)
                                                ->where('year', $year)
                                                ->where('day', $day)
                                                ->first();

                                            // echo $attendences

                                        @endphp

                                        <input class="form-check-input checkAttendence" type="checkbox"
                                            @if (auth('teacher')->check()) disabled @endif value="{{ $day }}"
                                            id="day"
                                            {{ $attendences?->number > 0 ? 'checked' : '' }} />
                                        <input class="form-check-input checkAttendence" type="checkbox"
                                            @if (auth('teacher')->check()) disabled @endif value="{{ $day }}"
                                            id="day"
                                            {{ $attendences?->number > 1 ? 'checked' : '' }} />
                                        <input class="form-check-input checkAttendence" type="checkbox"
                                            @if (auth('teacher')->check()) disabled @endif value="{{ $day }}"
                                            id="day"
                                            {{ $attendences?->number > 2 ? 'checked' : '' }} />
                                        {{--
@if ($attendences)
@for ($i = 1; $i <= $attendences->number; $i++)
<input class="form-check-input checkAttendence" type="checkbox" @if (auth('teacher')->check()) disabled @endif
value="{{ $day }}" id="day" checked />
@endfor
{{ null }}
@else
@endif --}}
                                        @php

                                            // if($attendences == null){
                                            //     echo "null";
                                            // }else{

                                            // }

                                            // if($test == null){
                                            //     echo "null";
                                            // }else{
                                            //     echo $test->number ;
                                            // }
                                            $attendence = App\Models\Attendence::where('student_id', $student->id)
                                                ->where('month', $month)
                                                ->where('year', $year)
                                                ->where('day', $day)
                                                ->first();

                                            // if($attendence == null){
                                            //     echo "null";
                                            // }else{
                                            //     echo $attendence->number ;
                                            // }
                                            // echo $attendence->id == null ? 'null' : $attendence->id ;

                                        @endphp


                                        {{-- @php

                                    if( $student->attendences->where('week', $week)
                                    ->where('month', $month)
                                    ->where('year', $year)
                                    ->where('day', $day)->get('number') === 1 ){
                                        echo '1';
                                    }else if( $student->attendences->where('week', $week)
                                    ->where('month', $month)
                                    ->where('year', $year)
                                    ->where('day', $day)->get('number') === 2 ){
                                        echo '2';
                                    }else{
                                        echo "0";
                                    } --}}

                                        @endphp



                                        {{-- <input class="form-check-input checkAttendence" type="checkbox" @if (auth('teacher')->check()) disabled @endif
                                            value="{{ $day }}" id="day"
                                            @if (count($student->attendences->where('week', $week)->where('month', $month)->where('year', $year)->where('day', $day)) > 0) checked @endif /> --}}
                                    </td>
                                @endfor
                                {{-- <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                            data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
                                        <div class="dropdown-menu">
                                            @if ($student->tests->count() == 0)
                                                <a class="dropdown-item"
                                                    href="{{ route('dashboard.evaluations.create', $student->id) }}">
                                                    <i class="bx bx-edit-alt me-2"></i>
                                                    {{ trans('evaluation.create') }}
                                                </a>
                                            @endif
                                            <a class="dropdown-item"
                                                href="{{ route('dashboard.evaluations.show', $student->id) }}">
                                                <i class="bx bx-show me-2"></i>
                                                {{ trans('evaluation.show') }}
                                            </a>

                                        </div>
                                    </div>
                                </td> --}}
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="11"><em>@lang('لا يوجد سجلات.')</em></td>
                        </tr>
                    @endif
                </tbody>
            </table>
            {{ $students->appends(request()->all())->links() }}
        </div>
    </div>
@endsection

@section('scripts')
    <link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
            });

            $(".checkAttendence").click(function(e) {
                const isChecked = $(this).is(":checked");
                const student = $(this).parents("td").parents("tr").attr("data-student");
                const week = $(this).parents("td").parents("tr").attr("data-week");
                const month = $(this).parents("td").parents("tr").attr("data-month");
                const year = $(this).parents("td").parents("tr").attr("data-year");
                const day = $(this).val();

                const data = {
                    student,
                    isChecked,
                    day,
                    week,
                    month,
                    year,
                }
                $.ajax({
                    url: '{{ route('dashboard.attendence.store') }}',
                    method: 'POST',
                    dataType: 'json',
                    data: data,
                    success: function(response) {
                        toastr.success(response["success"]);
                    }
                })
            })

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
            $('#week').on('change', function(event) {
                timer = setTimeout(function() {
                    submitForm();
                }, 1000);

            });
            $('#batch').on('change', function(event) {
                timer = setTimeout(function() {
                    submitForm();
                }, 1000);

            });
            $('#group').on('change', function(event) {
                timer = setTimeout(function() {
                    submitForm();
                }, 1000);

            });

            $('#registration_number').on('keyup', function(event) {
                $("#registration_number").focus();
                timer = setTimeout(function() {
                    submitForm();
                }, 4000);

            })
            $('#search').on('keyup', function(event) {
                $("#search").focus();
                timer = setTimeout(function() {
                    submitForm();
                }, 4000);

            })
            $('#start_date').on('change', function(event) {
                timer = setTimeout(function() {
                    submitForm();
                }, 1000);

            });
            $('#end_date').on('change', function(event) {
                timer = setTimeout(function() {
                    submitForm();
                }, 1000);

            });

            $('#rank').on('change', function(event) {
                timer = setTimeout(function() {
                    submitForm();
                }, 1000);

            });
            $('#passport').on('change', function(event) {
                timer = setTimeout(function() {
                    submitForm();
                }, 1000);

            });
            $('#perPage').on('change', function(event) {
                timer = setTimeout(function() {
                    submitForm();
                }, 1000);

            });
            function submitForm() {
                $("#filterAttendenceForm").submit();
            }


            $("#printSection").click(function(e) {
                let url = $(this).attr('data-url');
                var printWindow = window.open(url, '_blank', 'height=auto,width=auto');
                printWindow.print();
            });
        });
    </script>
@endsection
