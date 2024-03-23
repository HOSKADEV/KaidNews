@extends('layouts/contentNavbarLayout')

@section('title', trans('subject.title'))

@section('page-script')
    <script src="{{ asset('assets/js/pages-account-settings-account.js') }}"></script>
@endsection

@section('content')
    @include('dashboard.subject.create')
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">{{ trans('subject.dashboard') }} /</span> {{ trans('subject.subjects') }}
    </h4>
    <div class="card">
        <h5 class="card-header pt-0 mt-1">
            <div class="row  justify-content-between">
                <div class="form-group col-md-3 mr-5 mt-4">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createSubjectModal">
                        <span class="tf-icons bx bx-plus"></span>&nbsp; {{ trans('subject.create') }}
                    </button>
                </div>
                <div class="form-group col-md-3" dir="{{ config('app.locale') == 'ar' ? 'rtl' : 'ltr' }}">
                    <form action="" method="GET" id="searchSectionForm">
                        <label for="name" class="form-label">{{ trans('student.label.name') }}</label>
                        <input type="text" id="name" name="search" value="{{ Request::get('search') }}"
                            class="form-control input-solid"
                            placeholder="{{ Request::get('search') != '' ? '' : trans('student.placeholder.name') }}">
                    </form>
                </div>
            </div>
        </h5>
        <div class="table-responsive text-nowrap">
            <table class="table mb-2">
                <thead>
                    <tr class="text-nowrap">
                        <th>#</th>
                        <th>{{ trans('subject.name') }}</th>
                        <th>{{ trans('subject.coef') }}</th>
                        <th>{{ trans('app.actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($subjects))
                        @foreach ($subjects as $key => $subject)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $subject->name }}</td>
                                <td>{{ $subject->coef }}</td>
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                            data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
                                        <div class="dropdown-menu">

                                            <a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal"
                                                data-bs-target="#editSubjectModal{{ $subject->id }}">
                                                <i class="bx bx-edit-alt me-2"></i>
                                                {{ trans('subject.edit') }}
                                            </a>
                                            <a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal"
                                                data-bs-target="#deleteSubjectModal{{ $subject->id }}">
                                                <i class="bx bx-trash me-2"></i>
                                                {{ trans('subject.delete') }}
                                            </a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @include('dashboard.subject.edit')
                            @include('dashboard.subject.delete')
                        @endforeach
                    @else
                        <tr>
                            <td class="text-danger" colspan="4"><em>@lang('لا توجد سجلات.')</em></td>
                        </tr>
                    @endif
                </tbody>
            </table>
            {{ $subjects->links() }}
        </div>
    </div>
@endsection
