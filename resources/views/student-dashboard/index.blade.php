
@php
$isMenu = false;
$navbarHideToggle = false;
@endphp

@extends('layouts/contentNavbarLayout')

@section('title', trans('student.title-dashboard'))

@section('page-script')
    <script src="{{ asset('assets/js/pages-account-settings-account.js') }}"></script>
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card mb-4">
            <h5 class="card-header">{{ trans('app.review') }}</h5>
            <hr class="my-0">
            <div class="card-body">
                <h4 class="text-danger">لا يوجد اي تقييمات لحد الساعة </h4>
            </div>
        </div>
    </div>
</div>
@endsection
