@extends('layouts/contentNavbarLayout')

@section('title', trans('setting.title'))

@section('page-script')
    <script src="{{ asset('assets/js/pages-account-settings-account.js') }}"></script>
@endsection

@section('content')
@include('dashboard.setting.import.student')
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">{{ trans('setting.dashboard') }} /</span> {{ trans('setting.settings') }}
    </h4>
    <div class="card pt-3">
        <div class="card-body">
            <div class="row">
                <h5 class="card-title">{{ trans('setting.students') }}</h5>
                <div class="col-sm-12 col-md-3">
                    {{-- <p class="card-text">
                        <small class="text-muted">Last updated 3 mins ago</small>
                    </p> --}}
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#importStudentFileModal">
                        <span class="bx bxs-file-import"></span>&nbsp; {{ trans('setting.import.student') }}
                    </button>
 
                </div>
            </div>
            {{-- <p class="card-text">
                <small class="text-muted">Last updated 3 mins ago</small>
            </p> --}}
        </div>
    </div>
@endsection
