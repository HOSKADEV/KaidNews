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
            <form action="" method="GET" id="filterStudentForm">
                <div class="row  justify-content-between">
                    <div class="form-group col-md-2 px-1 mt-4">
                        <a href="{{ route('dashboard.students.create') }}" class="btn btn-primary text-white">
                            <span class="tf-icons bx bx-plus"></span>&nbsp; {{ trans('student.create') }}
                        </a>
                    </div>

                    <div class="form-group col-md-3" dir="{{ config('app.locale') == 'ar' ? 'rtl' : 'ltr' }}">
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
                    <div class="form-group col-md-2" dir="{{ config('app.locale') == 'ar' ? 'rtl' : 'ltr' }}">
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
                    </div>

                    <div class="form-group col-md-2 mr-5 mt-4">
                        @if (count($students))
                            <button target="_blank" id="printStudent"
                                data-url="{{ route('dashboard.print.students', [
                                    'group' => Request::get('group'),
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
                        <th>{{ trans('student.name') }}</th>
                        <th>{{ trans('student.email') }}</th>
                        <th>{{ trans('student.phone') }}</th>
                        <th>{{ trans('student.birthday') }}</th>
                        <th>{{ trans('student.state_place_of_birth') }}</th>
                        <th>{{ trans('student.gender') }}</th>
                        <th>{{ trans('student.registration_number') }}</th>
                        <th>{{ trans('student.group') }}</th>
                        <th>{{ trans('app.actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($students))
                        @foreach ($students as $key => $student)
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
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                            data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
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
                            </tr>
                            @include('dashboard.student.delete')
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
