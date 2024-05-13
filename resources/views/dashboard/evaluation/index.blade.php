@extends('layouts/contentNavbarLayout')

@section('title', trans('evaluation.title'))

@section('page-script')
    <script src="{{ asset('assets/js/pages-account-settings-account.js') }}"></script>
@endsection

@section('content')
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">{{ trans('evaluation.dashboard') }} /</span> {{ trans('evaluation.evaluations') }}
    </h4>
    <div class="card">
        <h5 class="card-header pt-0 mt-1">

            <form action="" method="GET" id="filterStudentEvaluationForm">
                <div class="row  justify-content-between">
                    {{-- <div class="form-group col-md-3" dir="{{ config('app.locale') == 'ar' ? 'rtl' : 'ltr' }}">
                        <label for="search" class="form-label">{{ trans('student.label.name') }}</label>
                        <input type="text" id="search" name="search" value="{{ Request::get('search') }}"
                            class="form-control input-solid"
                            placeholder="{{ Request::get('search') != '' ? '' : trans('student.placeholder.name') }}">

                    </div>
                    <div class="form-group col-md-3" dir="{{ config('app.locale') == 'ar' ? 'rtl' : 'ltr' }}">
                        <label for="name" class="form-label">{{ trans('student.label.registration_number') }}</label>
                        <input type="text" id="name" name="search" value="{{ Request::get('search') }}"
                            class="form-control input-solid"
                            placeholder="{{ Request::get('search') != '' ? '' : trans('student.placeholder.registration_number') }}">

                    </div>
                    <div class="form-group col-md-3" dir="{{ config('app.locale') == 'ar' ? 'rtl' : 'ltr' }}">
                        <label for="group" class="form-label">{{ trans('student.label.group') }}</label>
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
                    </div> --}}
                    <div class="row">
                        <div class="form-group col-md-3 mb-2" dir="{{ config('app.locale') == 'ar' ? 'rtl' : 'ltr' }}">
                            <label for="search" class="form-label">{{ trans('app.label.name') }}</label>
                            <input type="text" id="search" name="search" value="{{ Request::get('search') }}"
                                class="form-control input-solid"
                                placeholder="{{ Request::get('search') != '' ? '' : trans('app.placeholder.name') }}">
                        </div>
                        <div class="form-group col-md-3 mb-2" dir="{{ config('app.locale') == 'ar' ? 'rtl' : 'ltr' }}">
                            <label for="registration_number"
                                class="form-label">{{ trans('student.label.registration_number') }}</label>
                            <input type="text" id="registration_number" name="registration_number"
                                value="{{ Request::get('registration_number') }}" class="form-control input-solid"
                                placeholder="{{ Request::get('registration_number') != '' ? '' : trans('student.placeholder.registration_number') }}">
                        </div>

                        <div class="form-group col-md-2 mb-2 mb-2"
                            dir="{{ config('app.locale') == 'ar' ? 'rtl' : 'ltr' }}">
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
                        <div class="form-group col-md-2 mb-2" dir="{{ config('app.locale') == 'ar' ? 'rtl' : 'ltr' }}">
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
                        <div class="form-group col-md-2 mb-2">
                            <label for="year" class="form-label">{{ trans('app.label.year') }}</label>
                            <select class="form-select" id="year" name="year" aria-label="Default select example">
                                <option value="">{{ trans('app.select.year') }}</option>
                                <option value="">{{ trans('app.option.year_all') }}</option>
                                @for ($i = $start_date; $i <= \Carbon\Carbon::now()->format('Y'); $i++)
                                    <option value="{{ $i }}"
                                        {{ Request::get('year') == $i ? 'selected' : '' }}>
                                        {{ trans('app.year') . ' ' . $i }}</option>
                                @endfor
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

                        {{-- <div class="form-group col-md-2 mb-2">
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
                                <option value="أ">{{ trans('app.batchs.أ') }}</option>
                                <option value="ب">{{ trans('app.batchs.ب') }}</option>
                                <option value="ج">{{ trans('app.batchs.ج') }}</option>
                            </select>
                        </div>

                        <div class="form-group col-md-4" dir="{{ config('app.locale') == 'ar' ? 'rtl' : 'ltr' }}">
                            <label for="registration_number"
                                class="form-label">{{ trans('app.label.registration_number') }}</label>
                            <input type="text" id="registration_number" name="registration_number"
                                value="{{ Request::get('registration_number') }}" class="form-control input-solid"
                                placeholder="{{ Request::get('registration_number') != '' ? '' : trans('app.placeholder.registration_number') }}">
                        </div>

                        <div class="form-group col-md-4 mb-2">
                            <label for="search" class="form-label">{{ trans('app.label.name') }}</label>
                            <input type="text" id="search" name="search" value="{{ Request::get('search') }}"
                                class="form-control input-solid"
                                placeholder="{{ Request::get('search') != '' ? '' : trans('app.placeholder.name') }}">
                        </div> --}}

                    </div>
                    <div class="form-group col-md-3 mt-4">
                        @if (count($students))
                            <button target="_blank" id="printStudentEvaluation"
                                data-url="{{ route('dashboard.print.review', [
                                    'group' => Request::get('group'),
                                    'batch' => Request::get('batch'),
                                    'search' => Request::get('search'),
                                    'registration_number' => Request::get('registration_number'),
                                    'week'  => Request::get('week'),
                                    'month' => Request::get('month'),
                                    'year'  => Request::get('year'),
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
                        <th>{{ trans('student.birthday') }}</th>
                        <th>{{ trans('student.gender') }}</th>
                        <th>{{ trans('student.registration_number') }}</th>
                        <th>{{ trans('student.group') }}</th>
                        <th>{{ trans('evaluation.moyen') }}</th>
                        <th>{{ trans('app.actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($students))
                        @foreach ($students as $key => $student)
                            @php
                                $rowNumber = ($students->currentPage() - 1) * $students->perPage() + $loop->index + 1;
                            @endphp
                            <tr>
                                <th scope="row">{{ $rowNumber }}</th>
                                <td>{{ $student->name }}</td>
                                <td>{{ $student->birthday }}</td>
                                <td>{{ $student->gender == 1 ? trans('student.male') : trans('student.female') }}</td>
                                <td>{{ $student->registration_number }}</td>
                                <td>{{ $student->group }}</td>
                                <td class="text-center">
                                    {{ $student->tests->count() > 0 ? number_format($student->moyen, 2) : 'لم يتم تقييم بعد' }}
                                    @if ($student->evaluations)
                                        @if ($student->evaluations->rank != 0)
                                          <img src="{{ asset('assets/prize/' . $student->evaluations->rank . '.svg') }}"
                                          width="30px" height="30px" alt="" srcset="">
                                        @endif
                                        @if ($student->evaluations->golden_passport == 1)
                                            <img src="{{ asset('assets/prize/reward.png') }}" width="30px"
                                                height="30px" alt="" srcset="">
                                        @endif
                                    @endif
                                </td>
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                            data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
                                        <div class="dropdown-menu">
                                            @if ($student->tests->count() == 0)
                                                @if (auth('admin')->check())
                                                    <a class="dropdown-item"
                                                        href="{{ route('dashboard.evaluations.create', $student->id) }}">
                                                        <i class="bx bx-edit-alt me-2"></i>
                                                        {{ trans('evaluation.create') }}
                                                    </a>
                                                @endif
                                            @else
                                                @if (auth('admin')->check())
                                                    <button target="_blank"
                                                        data-url="{{ route('dashboard.print.reviewnote', [
                                                            'student_id' => $student->id,
                                                        ]) }}"
                                                        class="dropdown-item downloadReview">
                                                        <i class="bx bxs-download me-2"></i>
                                                        {{ trans('app.download_review') }}
                                                    </button>
                                                    <a class="dropdown-item"
                                                        href="{{ route('dashboard.evaluations.edit', $student->id) }}">
                                                        <i class='bx bx-edit me-2'></i>
                                                        {{ trans('evaluation.edit') }}
                                                    </a>
                                                @endif
                                            @endif
                                            <a class="dropdown-item"
                                                href="{{ route('dashboard.evaluations.show', $student->id) }}">
                                                <i class="bx bx-show me-2"></i>
                                                {{ trans('evaluation.show') }}
                                            </a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="9"><em>@lang('لا يوجد سجلات.')</em></td>
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

            $('#group').on('change', function(event) {
                timer = setTimeout(function() {
                    submitForm();
                }, 1000);

            });
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
            $('#batch').on('change', function(event) {
                timer = setTimeout(function() {
                    submitForm();
                }, 1000);

            });
            $('#year').on('change', function(event) {
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
                $("#filterStudentEvaluationForm").submit();
            }
            $("#printStudentEvaluation").click(function(e) {
                let url = $(this).attr('data-url');
                var printWindow = window.open(url, '_blank', 'height=auto,width=auto');
                printWindow.print();
            });

            $(".downloadReview").click(function(e) {
                let url = $(this).attr('data-url');
                var printWindow = window.open(url, '_blank', 'height=auto,width=auto');
                printWindow.print();
            });
        });
    </script>
@endsection
