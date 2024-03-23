@extends('layouts/contentNavbarLayout')

@section('title', trans('setting.title'))

@section('page-script')
    <script src="{{ asset('assets/js/pages-account-settings-account.js') }}"></script>
@endsection

@section('content')
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">{{ trans('setting.dashboard') }} /</span> {{ trans('setting.settings') }}
    </h4>
    <div class="card">
    </div>
@endsection
