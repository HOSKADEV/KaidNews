@extends('layouts/contentNavbarLayout')

@section('title', trans('admin.create'))

@section('page-script')
    <script src="{{ asset('assets/js/pages-account-settings-account.js') }}"></script>
@endsection

@section('content')
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">{{ trans('admin.dashboard') }} / {{ trans('admin.admins') }}/ </span>
        {{ trans('admin.create') }}
    </h4>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ trans('admin.create') }}</h5>
            <form method="post" action="{{ route('dashboard.admins.store') }}">
                @csrf
                <div class="row ">
                    <div class="col-sm-12 col-md-4 mb-2">
                        <label for="name" class="form-label text-end">{{ trans('app.label.name') }}</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                            name="name" value="{{ old('name') }}"
                            placeholder="{{ trans('app.placeholder.name') }}">
                        @error('name')
                            <small class="text-danger d-block mt-1">
                                {{ $message }}
                            </small>
                        @enderror
                    </div>

                    <div class="col-sm-12 col-md-4 mb-2">
                        <label for="email" class="form-label">{{ trans('app.label.email') }}</label>
                        <input type="text" class="form-control @error('email') is-invalid @enderror" name="email"
                            value="{{ old('email') }}" placeholder="{{ trans('app.placeholder.email') }}">
                        @error('email')
                            <small class="text-danger d-block">
                                {{ $message }}
                            </small>
                        @enderror
                    </div>
                    <div class="col-sm-12 col-md-4 mb-2">
                        <label for="phone" class="form-label">{{ trans('app.label.phone') }}</label>
                        <input type="text" class="form-control @error('phone') is-invalid @enderror" name="phone"
                            value="{{ old('phone') }}" placeholder="{{ trans('app.placeholder.phone') }}">
                        @error('phone')
                            <small class="text-danger d-block">
                                {{ $message }}
                            </small>
                        @enderror
                    </div>
                    <div class="col-sm-12 col-md-6 mb-2">
                        <label for="password" class="form-label">{{ trans('app.label.password') }}</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror" name="password">
                        @error('password')
                            <small class="text-danger d-block">
                                {{ $message }}
                            </small>
                        @enderror
                    </div>
                    <div class="col-sm-12 col-md-6 mb-2">
                        <label for="password_confirmation"
                            class="form-label">{{ trans('app.label.confirme_password') }}</label>
                        <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror"
                            name="password_confirmation">
                        @error('password_confirmation')
                            <small class="text-danger d-block">
                                {{ $message }}
                            </small>
                        @enderror
                    </div>

                    <div class="col-sm-12 mt-3 d-flex">
                        <div class="col d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary">{{ trans('app.save') }}</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
