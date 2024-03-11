@extends('layouts/contentNavbarLayout')

@section('title', trans('dashboard.title'))

@section('page-script')
    <script src="{{ asset('assets/js/pages-account-settings-account.js') }}"></script>
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-6 col-md-3 mb-4">
            <div class="card">
                <div class="card-body">
                    <div class="card-title d-flex align-items-start justify-content-between">
                        <span class="fw-semibold d-block mb-1">{{ trans('dashboard.admins') }}</span>
                        <div class="">
                            <i class="fa fa-user-secret fa-3x" aria-hidden="true"></i>
                        </div>
                    </div>
                    <h3 class="card-title mb-2">{{ $admins }}</h3>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-md-3 mb-4">
            <div class="card">
                <div class="card-body">
                    <div class="card-title d-flex align-items-start justify-content-between">
                        <span class="fw-semibold d-block mb-1">{{ trans('dashboard.teachers') }}</span>
                        <div class="">
                            <i class="fa fa-users fa-3x" aria-hidden="true"></i>
                        </div>
                    </div>
                    <h3 class="card-title mb-2">{{ $teachers }}</h3>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-md-3 mb-4">
            <div class="card">
                <div class="card-body">
                    <div class="card-title d-flex align-items-start justify-content-between">
                        <span class="fw-semibold d-block mb-1">{{ trans('dashboard.students') }}</span>
                        <div class="">
                            <i class="fa fa-graduation-cap fa-3x" aria-hidden="true"></i>
                        </div>
                    </div>
                    <h3 class="card-title mb-2">{{ $students }}</h3>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-md-3 mb-4">
            <div class="card">
                <div class="card-body">
                    <div class="card-title d-flex align-items-start justify-content-between">
                        <span class="fw-semibold d-block mb-1">{{ trans('dashboard.reviews') }}</span>
                        <div class="">
                            <i class="fa fa-star fa-3x" aria-hidden="true"></i>
                        </div>
                    </div>
                    <h3 class="card-title mb-2">100</h3>
                </div>
            </div>
        </div>
    </div>
@endsection
