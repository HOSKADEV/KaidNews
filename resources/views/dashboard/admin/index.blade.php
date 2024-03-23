@extends('layouts/contentNavbarLayout')

@section('title', trans('admin.title'))

@section('page-script')
    <script src="{{ asset('assets/js/pages-account-settings-account.js') }}"></script>
@endsection

@section('content')
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">{{ trans('admin.dashboard') }} /</span> {{ trans('admin.admins') }}
    </h4>

    <div class="card">
        <h5 class="card-header pt-0 mt-1">
            <div class="row  justify-content-between">
                <div class="form-group col-md-3 mr-5 mt-4">
                    <a href="{{ route('dashboard.admins.create') }}" class="btn btn-primary text-white">
                        <span class="tf-icons bx bx-plus"></span>&nbsp; {{ trans('admin.create') }}
                    </a>
                </div>

                <div class="form-group col-md-3" dir="{{ config('app.locale') == 'ar' ? 'rtl' : 'ltr' }}">
                    <form action="" method="GET" id="searchSectionForm">
                        <label for="name" class="form-label">{{ trans('admin.label.name') }}</label>
                        <input type="text" id="name" name="search" value="{{ Request::get('search') }}"
                            class="form-control input-solid"
                            placeholder="{{ Request::get('search') != '' ? '' : trans('admin.placeholder.name') }}">
                    </form>
                </div>
            </div>
        </h5>
        <div class="table-responsive text-nowrap">
            <table class="table mb-2">
                <thead>
                    <tr class="text-nowrap">
                        <th>#</th>
                        <th>{{ trans('admin.name') }}</th>
                        <th>{{ trans('admin.email') }}</th>
                        <th>{{ trans('admin.phone') }}</th>
                        <th>{{ trans('app.actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($admins as $key => $admin)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $admin->name }}</td>
                            <td>{{ $admin->email }}</td>
                            <td>{{ $admin->phone }}</td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                        data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="{{ route('dashboard.admins.edit', $admin->id) }}">
                                            <i class="bx bx-edit-alt me-2"></i>
                                            {{ trans('admin.edit') }}
                                        </a>
                                        <a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal"
                                            data-bs-target="#deleteAdminModal{{ $admin->id }}">
                                            <i class="bx bx-trash me-2"></i>
                                            {{ trans('admin.delete') }}
                                        </a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @include('dashboard.admin.delete')
                    @endforeach
                </tbody>
            </table>
            {{ $admins->links() }}
        </div>
    </div>
@endsection
