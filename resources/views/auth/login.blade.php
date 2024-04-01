@extends('layouts/blankLayout')

@section('title', trans('auth/auth.login'))

@section('page-style')
    <!-- Page -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/page-auth.css') }}">
@endsection

@section('content')
    <div class="container-xxl">
        <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner">
                <!-- Register -->
                <div class="card">
                    <div class="card-body" dir="rtl">
                        <!-- Logo -->
                        <div class="app-brand justify-content-center">
                            <a href="{{ url('/') }}" class="app-brand-link">
                                <img class="app-brand-logo" height="100px" src="{{ asset('assets/logo/kaid-logo.png') }}"
                                    alt="" srcset="">
                                {{-- <span class="app-brand-text demo text-body fw-bolder">{{ config('app.name') }}</span> --}}
                            </a>
                        </div>
                        <!-- /Logo -->
                        <h4 class="mb-2">{{ trans('auth/auth.login') }}</h4>
                        @if (Session::get('error'))
                            <div class="alert alert-danger" role="alert">
                                {{ Session::get('error') }}
                            </div>
                        @endif

                        <form id="formAuthentication" class="mb-3" action="{{ route('auth.login') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="email" class="form-label">{{ trans('auth/auth.email') }}</label>
                                <input type="text" class="form-control mb-1 @error('email') is-invalid @enderror"
                                    id="email" name="email" placeholder="ahmed@kaid.com" autofocus>
                                @error('email')
                                    <small class="text-danger d-block">
                                        {{ $message }}
                                    </small>
                                @enderror
                            </div>

                            <div class="mb-3 form-password-toggle">
                                <div class="d-flex justify-content-between">
                                    <label class="form-label" for="password">{{ trans('auth/auth.password') }}</label>
                                    <a href="{{ url('auth/forgot-password-basic') }}">
                                        <small>{{ trans('auth/auth.forgot_password') }}</small>
                                    </a>
                                </div>
                                <div class="input-group mb-2">
                                    <input type="password" id="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                        aria-describedby="password" style="border-radius: none" />

                                    <span class="input-group-text" style="border-radius: none">
                                        <span class="ursor-pointer"><i class="bx bx-hide"></i></span>
                                    </span>
                                </div>
                                @error('password')
                                    <small class="text-danger d-block">
                                        {{ $message }}
                                    </small>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <button class="btn btn-primary d-grid w-100"
                                    type="submit">{{ trans('auth/auth.loginSubmit') }}</button>
                            </div>
                        </form>

                        <p class="text-center">
                            <span>{{ trans('auth/auth.have_not_account') }}</span>
                            <a href="{{ route('auth.registerForm') }}">
                                <span>{{ trans('auth/auth.create_account') }}</span>
                            </a>
                        </p>
                    </div>
                </div>
            </div>
            <!-- /Register -->
        </div>
    </div>
    </div>
@endsection
