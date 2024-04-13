@extends('layouts/contentNavbarLayout')

@section('title', trans('student.title'))

@section('page-script')
    <script src="{{ asset('assets/js/pages-account-settings-account.js') }}"></script>
@endsection

@section('content')
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">{{ trans('student.dashboard') }} /</span> {{ trans('student.students') }}
    </h4>
    <div class="card">
        <h5 class="card-header pt-0 mt-1">
            <form action="" method="GET" id="filterStudentForm" class="">
                <div class="row">
                    @if (auth('admin')->check())
                        <div class="form-group col-md-2 px-1 mt-4">
                            <a href="{{ route('dashboard.students.create') }}" class="btn btn-primary text-white">
                                <span class="tf-icons bx bx-plus"></span>&nbsp; {{ trans('student.create') }}
                            </a>
                        </div>
                    @endif
                    <div class="form-group col-md-3 mb-2" dir="{{ config('app.locale') == 'ar' ? 'rtl' : 'ltr' }}">
                        <label for="search" class="form-label">{{ trans('student.label.name') }}</label>
                        <input type="text" id="search" name="search" value="{{ Request::get('search') }}"
                            class="form-control input-solid"
                            placeholder="{{ Request::get('search') != '' ? '' : trans('teacher.placeholder.name') }}">
                    </div>
                    <div class="form-group col-md-3 mb-2" dir="{{ config('app.locale') == 'ar' ? 'rtl' : 'ltr' }}">
                        <label for="registration_number"
                            class="form-label">{{ trans('student.label.registration_number') }}</label>
                        <input type="text" id="registration_number" name="registration_number"
                            value="{{ Request::get('registration_number') }}" class="form-control input-solid"
                            placeholder="{{ Request::get('registration_number') != '' ? '' : trans('student.placeholder.registration_number') }}">
                    </div>

                    <div class="form-group col-md-2 mb-2 mb-2" dir="{{ config('app.locale') == 'ar' ? 'rtl' : 'ltr' }}">
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
                </div>
            </form>
            <div class="row">
                @if (count($students))
                    <div class="form-group col-md-2 mt-4">
                        <button target="_blank" id="printStudent"
                            data-url="{{ route('dashboard.print.students', [
                                'batch' => Request::get('batch'),
                                'group' => Request::get('group'),
                                'search' => Request::get('search'),
                                'registration_number' => Request::get('registration_number'),
                            ]) }}"
                            class="btn
                        btn-primary text-white mr-2">
                            <span class="bx bxs-printer"></span>&nbsp; {{ trans('app.print') }}
                        </button>
                    </div>
                @endif
            </div>

        </h5>
        <div class="table-responsive text-nowrap">
            <table class="table mb-2">
                <thead>
                    <tr class="text-nowrap">
                        <th>#</th>
                        <th>{{ trans('student.name') }}</th>
                        <th>{{ trans('student.email') }}</th>
                        <th>{{ trans('student.phone') }}</th>
                        <th>{{ trans('student.birthday') }}</th>
                        <th>{{ trans('student.state_place_of_birth') }}</th>
                        <th>{{ trans('student.gender') }}</th>
                        <th>{{ trans('student.registration_number') }}</th>
                        <th>{{ trans('student.group') }}</th>
                        @if (auth('admin')->check())
                            <th>{{ trans('app.actions') }}</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @forelse ($students as $key => $student)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $student->name }}</td>
                            <td>{{ $student->email }}</td>
                            <td>{{ $student->phone }}</td>
                            <td>{{ $student->birthday }}</td>
                            <td>{{ $student->state_of_birth }} -{{ $student->place_of_birth }}</td>
                            <td>{{ $student->gender == 1 ? trans('student.male') : trans('student.female') }}</td>
                            <td>{{ $student->registration_number }}</td>
                            <td>{{ $student->group }}</td>
                            @if (auth('admin')->check())
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                            data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item"
                                                href="{{ route('dashboard.students.edit', $student->id) }}">
                                                <i class="bx bx-edit-alt me-2"></i>
                                                {{ trans('student.edit') }}
                                            </a>
                                            <a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal"
                                                data-bs-target="#deleteStudentModal{{ $student->id }}">
                                                <i class="bx bx-trash me-2"></i>
                                                {{ trans('student.delete') }}
                                            </a>
                                        </div>
                                    </div>
                                </td>
                            @endif
                        </tr>
                        @include('dashboard.student.delete')
                    @empty
                        <tr>
                            <td colspan="10" class="text-center text-danger"><em>@lang('لا يوجد سجلات.')</em></td>
                        </tr>
                    @endforelse
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

            // $('#search').on('keyup', function(event) {
            //     // console.log('search' , $('#search').val());
            //     $("#search").focus();
            //     timer = setTimeout(function() {
            //         submitForm();
            //     }, 4000);

            // })
            $('#search').on('keyup', function(event) {
                $("#search").focus();
                timer = setTimeout(function() {
                    submitForm();
                }, 4000);

            })
            $('#registration_number').on('keyup', function(event) {
                $("#registration_number").focus();
                timer = setTimeout(function() {
                    submitForm();
                }, 4000);

            })

            function submitForm() {
                $("#filterStudentForm").submit();
            }
            $("#printStudent").click(function(e) {
                let url = $(this).attr('data-url');
                var printWindow = window.open(url, '_blank', 'height=auto,width=auto');
                printWindow.print();
            });
        });
    </script>
@endsection
