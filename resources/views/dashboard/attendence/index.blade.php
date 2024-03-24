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
                    <div class="form-group col-md-2">
                        <label for="week" class="form-label">{{ trans('attendence.label.week') }}</label>
                        <select class="form-select" id="week" name="week" aria-label="Default select example">
                            @if ($week)
                                <option value="{{ $week }}"> {{ trans('attendence.weeks.' . $week) }}</option>
                            @else
                                <option value="">{{ trans('attendence.select.week') }}</option>
                            @endif
                            @for ($i = 1; $i <= 4; $i++)
                                <option value="{{ $i }}">{{ trans('attendence.weeks.' . $i) }}</option>
                            @endfor
                        </select>
                    </div>

                    <div class="form-group col-md-2">
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

                    <div class="form-group col-md-2">
                        <label for="group" class="form-label">{{ trans('attendence.label.group') }}</label>
                        <select class="form-select" id="group" name="group" aria-label="Default select example">
                            @if (Request::get('group') != null)
                                <option value="{{ Request::get('group') }}">
                                    {{ trans('attendence.groups.' . Request::get('group')) }}</option>
                            @else
                                <option value="">{{ trans('attendence.select.group') }}</option>
                            @endif
                            <option value="">{{ trans('app.all') }}</option>

                            @for ($group = 1; $group <= $groups; $group++)
                                <option value="{{ $group }}">{{ trans('attendence.groups.' . $group) }}</option>
                            @endfor
                        </select>
                    </div>

                    <div class="form-group col-md-4">
                        <label for="search" class="form-label">{{ trans('attendence.label.search') }}</label>
                        <input type="text" id="search" name="search" value="{{ Request::get('search') }}"
                            class="form-control input-solid"
                            placeholder="{{ Request::get('search') != '' ? '' : trans('attendence.placeholder.search') }}">
                    </div>


                    <div class="form-group col-md-2 mr-5 mt-4">
                        @if (count($students))
                            <button target="_blank" id="printSection"
                                data-url="{{ route('dashboard.print.attendence', [
                                    'group' => Request::get('group'),
                                    'month' => Request::get('month'),
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
                        {{-- <th>{{ trans('app.actions') }}</th> --}}
                    </tr>
                </thead>
                <tbody>
                    @if (count($students))
                        @foreach ($students as $key => $student)
                            <tr data-student="{{ $student->id }}" data-week="{{ $week }}"
                                data-month="{{ $month }}" data-year="{{ $year }}">
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $student->name }}</td>
                                <td>{{ $student->gender == 1 ? trans('student.male') : trans('student.female') }}</td>
                                <td>{{ $student->registration_number }}</td>
                                <td>{{ trans('attendence.groups.' . $student->group) }}</td>

                                @for ($day = 1; $day <= $days; $day++)
                                    <td>
                                        <input class="form-check-input checkAttendence" type="checkbox" @if (auth('admin')->check()) disabled @endif
                                            value="{{ $day }}" id="day"
                                            @if (count(
                                                    $student->attendences->where('week', $week)->where('month', $month)->where('year', $year)->where('day', $day)) > 0) checked @endif />
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
            {{ $students->links() }}
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
            $('#group').on('change', function(event) {
                timer = setTimeout(function() {
                    submitForm();
                }, 1000);

            });

            $('#search').on('keyup', function(event) {
                $("#search").focus();
                timer = setTimeout(function() {
                    submitForm();
                }, 4000);

            })

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
