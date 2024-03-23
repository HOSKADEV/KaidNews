@extends('layouts/contentNavbarLayout')

@section('title', trans('teacher.title'))

@section('page-script')
    <script src="{{ asset('assets/js/pages-account-settings-account.js') }}"></script>
@endsection

@section('content')
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">{{ trans('teacher.dashboard') }} /</span> {{ trans('teacher.teachers') }}
    </h4>
    <div class="card">
        <h5 class="card-header pt-0 mt-1">
            <div class="row  justify-content-between">
                <div class="form-group col-md-4 mr-5 mt-4">
                    <a href="{{ route('dashboard.teachers.create') }}" class="btn btn-primary text-white">
                        <span class="tf-icons bx bx-plus"></span>&nbsp; {{ trans('teacher.create') }}
                    </a>
                </div>

                <div class="form-group col-md-4" dir="{{ config('app.locale') == 'ar' ? 'rtl' : 'ltr' }}">
                    <form action="" method="GET" id="filterTeacherForm">
                        <label for="search" class="form-label">{{ trans('teacher.label.name') }}</label>
                        <input type="text" id="search" name="search" value="{{ Request::get('search') }}"
                            class="form-control input-solid"
                            placeholder="{{ Request::get('search') != '' ? '' : trans('teacher.placeholder.name') }}">
                    </form>
                </div>
                <div class="form-group col-md-2 mr-5 mt-4">
                    @if (count($teachers))
                        <button target="_blank" id="printTeacher" data-url="{{ route('dashboard.print.teachers') }}"
                            class="btn
                        btn-primary text-white">
                            <span class="bx bxs-printer"></span>&nbsp; {{ trans('app.print') }}
                        </button>
                    @endif
                </div>
            </div>
        </h5>
        <div class="table-responsive text-nowrap">
            <table class="table mb-2">
                <thead>
                    <tr class="text-nowrap">
                        <th>#</th>
                        <th>{{ trans('teacher.name') }}</th>
                        <th>{{ trans('teacher.email') }}</th>
                        <th>{{ trans('teacher.phone') }}</th>
                        <th>{{ trans('teacher.birthday') }}</th>
                        <th>{{ trans('teacher.gender') }}</th>
                        <th>{{ trans('app.actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($teachers))
                        @foreach ($teachers as $key => $teacher)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $teacher->name }}</td>
                                <td>{{ $teacher->email }}</td>
                                <td>{{ $teacher->phone }}</td>
                                <td>{{ $teacher->birthday }}</td>
                                <td>{{ $teacher->gender == 1 ? trans('teacher.male') : trans('teacher.female') }}</td>
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                            data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item"
                                                href="{{ route('dashboard.teachers.edit', $teacher->id) }}">
                                                <i class="bx bx-edit-alt me-2"></i>
                                                {{ trans('teacher.edit') }}
                                            </a>
                                            <a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal"
                                                data-bs-target="#deleteTeacherModal{{ $teacher->id }}">
                                                <i class="bx bx-trash me-2"></i>
                                                {{ trans('teacher.delete') }}
                                            </a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @include('dashboard.teacher.delete')
                        @endforeach
                    @else
                        <tr>
                            <td colspan="9"><em>@lang('لا يوجد سجلات.')</em></td>
                        </tr>
                    @endif
                </tbody>
            </table>
            {{ $teachers->links() }}
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

            $('#search').on('keyup', function(event) {
                $("#search").focus();
                timer = setTimeout(function() {
                    submitForm();
                }, 4000);

            })

            function submitForm() {
                $("#filterTeacherForm").submit();
            }
            $("#printTeacher").click(function(e) {
                let url = $(this).attr('data-url');
                var printWindow = window.open(url, '_blank', 'height=auto,width=auto');
                printWindow.print();
            });
        });
    </script>
@endsection
