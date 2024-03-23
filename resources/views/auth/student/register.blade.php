@extends('layouts/blankLayout')

@section('title', 'Register Student')

@section('page-style')
    <!-- Page -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/page-auth.css') }}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    {{-- <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}"> --}}
    <style>
        .f1 {
            padding: 25px;
            background: #fff;
            border-radius: 4px;
        }

        .f1 h3 {
            margin-top: 0;
            margin-bottom: 5px;
            text-transform: uppercase;
        }

        .f1-steps {
            overflow: hidden;
            position: relative;
            margin-top: 20px;
        }

        .f1-progress {
            position: absolute;
            top: 24px;
            /* left: 0; */
            right: 0;
            width: 100%;
            height: 1px;
            background: #ddd;
        }

        .f1-progress-line {
            position: absolute;
            top: 0;
            /* left: 0; */
            right: 0;
            height: 1px;
            background: #f35b3f;
        }

        .f1-step {
            position: relative;
            /* float: left; */
            float: right;
            width: 25%;
            /* padding: 0 5px; */
        }

        .f1-step-icon {
            display: inline-block;
            width: 40px;
            height: 40px;
            margin-top: 4px;
            background: #ddd;
            font-size: 16px;
            color: #fff;
            line-height: 40px;
            border-radius: 50%;
        }

        .f1-step.activated .f1-step-icon {
            background: #fff;
            border: 1px solid #f35b3f;
            color: #f35b3f;
            line-height: 38px;
        }

        .f1-step.active .f1-step-icon {
            width: 48px;
            height: 48px;
            margin-top: 0;
            background: #f35b3f;
            font-size: 22px;
            line-height: 48px;
        }

        .f1-step p {
            color: #ccc;
        }

        .f1-step.activated p {
            color: #f35b3f;
        }

        .f1-step.active p {
            color: #f35b3f;
        }

        .f1 fieldset {
            display: none;
            /* text-align: left; */
        }

        .f1-buttons {
            text-align: right;
        }

        .f1 .input-error {
            border-color: #f35b3f;
        }
    </style>
@endsection


@section('content')
    <div class="d-flex justify-content-center align-items-center" dir="rtl" style="min-height: 100vh">
        <div class="container">
            <div class="card">
                <div class="card-body">
                    <form class="new-added-form f1" method="post" action="{{ route('auth.register') }}">
                        @csrf
                        <h5 class="card-title">{{ trans('auth/student.register') }}</h5>
                        <div class="f1-steps justify-content-start text-right">
                            <div class="f1-progress">
                                <div class="f1-progress-line" data-now-value="25" data-number-of-steps="4"
                                    style="width: 25%;"></div>
                            </div>

                            <div class="f1-step active">
                                <div class="f1-step-icon">
                                    <i class='bx bx-user bx-md' style="margin: 0 5px;"></i>
                                </div>
                                <p>{{ trans('auth/student.personal_information') }}</p>
                            </div>
                            <div class="f1-step">
                                <div class="f1-step-icon">
                                    <i class='bx bxs-graduation bx-md' style="margin: 0 5px;"></i>
                                </div>
                                <p>{{ trans('auth/student.education_information') }}</p>
                            </div>
                            <div class="f1-step">
                                <div class="f1-step-icon">
                                    <i class='bx bxs-cog bx-md' style="margin: 0 2px;"></i>
                                </div>
                                <p>{{ trans('auth/student.account_information') }}</p>
                            </div>
                            <div class="f1-step">
                                <div class="f1-step-icon">
                                    <i class='bx bxs-file-blank bx-md' style="margin: 0 2px;"></i>
                                </div>
                                <p>{{ trans('auth/student.review_information') }}</p>
                            </div>
                        </div>

                        <fieldset>
                            <div id="personal_information" class="">
                                <div class="row text-right">
                                    <div class="col-sm-12 col-md-3 mb-2 ">
                                        <label for="firstname_ar"
                                            class="form-label text-end">{{ trans('auth/student.firstname_ar') }}</label>
                                        <input type="text"
                                            class="form-control firstname_ar @error('firstname_ar') is-invalid @enderror"
                                            name="firstname_ar" value="{{ old('firstname_ar') }}"
                                            placeholder="{{ trans('auth/student.placeholder.firstname_ar') }}">
                                        @error('firstname_ar')
                                            <small class="text-danger d-block mt-1">
                                                {{ $message }}
                                            </small>
                                        @enderror
                                    </div>
                                    <div class="col-sm-12 col-md-3 mb-2">
                                        <label for="lastname_ar"
                                            class="form-label">{{ trans('auth/student.lastname_ar') }}</label>
                                        <input type="text"
                                            class="form-control lastname_ar @error('lastname_ar') is-invalid @enderror"
                                            name="lastname_ar" value="{{ old('lastname_ar') }}"
                                            placeholder="{{ trans('auth/student.placeholder.lastname_ar') }}">
                                        @error('lastname_ar')
                                            <small class="text-danger d-block">
                                                {{ $message }}
                                            </small>
                                        @enderror
                                    </div>
                                    <div class="col-sm-12 col-md-3 mb-2">
                                        <label for="firstname_fr"
                                            class="form-label">{{ trans('auth/student.firstname_fr') }}</label>
                                        <input type="text"
                                            class="form-control firstname_fr @error('firstname_fr') is-invalid @enderror"
                                            name="firstname_fr" dir="ltr" value="{{ old('firstname_fr') }}"
                                            placeholder="{{ trans('auth/student.placeholder.firstname_fr') }}">
                                        @error('firstname_fr')
                                            <small class="text-danger d-block">
                                                {{ $message }}
                                            </small>
                                        @enderror
                                    </div>
                                    <div class="col-sm-12 col-md-3 mb-2">
                                        <label for="lastname_fr"
                                            class="form-label">{{ trans('auth/student.lastname_fr') }}</label>
                                        <input type="text" dir="ltr"
                                            class="form-control lastname_fr @error('lastname_fr') is-invalid @enderror"
                                            name="lastname_fr" value="{{ old('lastname_fr') }}"
                                            placeholder="{{ trans('auth/student.placeholder.lastname_fr') }}">
                                        @error('lastname_fr')
                                            <small class="text-danger d-block">
                                                {{ $message }}
                                            </small>
                                        @enderror
                                    </div>
                                    <div class="col-sm-12 col-md-3 mb-2">
                                        <label for="gender" class="form-label">{{ trans('auth/student.gender') }}</label>
                                        <select class="form-select gender @error('gender') is-invalid @enderror"
                                            name="gender"value="{{ old('gender') }}">
                                            <option value="" selected>-- {{ trans('auth/student.select_gender') }} --
                                            </option>
                                            <option value="1">{{ trans('auth/student.gender_male') }}</option>
                                            <option value="2">{{ trans('auth/student.gender_female') }}</option>
                                        </select>
                                        @error('gender')
                                            <small class="text-danger d-block">
                                                {{ $message }}
                                            </small>
                                        @enderror
                                    </div>
                                    <div class="col-sm-12 col-md-3 mb-2">
                                        <label for="birthday"
                                            class="form-label">{{ trans('auth/student.birthday') }}</label>
                                        <input type="date"
                                            class="form-control birthday @error('birthday') is-invalid @enderror"
                                            name="birthday" value="{{ old('birthday') }}">
                                        @error('birthday')
                                            <small class="text-danger d-block">
                                                {{ $message }}
                                            </small>
                                        @enderror
                                    </div>
                                    <div class="col-sm-12 col-md-3 mb-2">
                                        <label for="state_of_birth"
                                            class="form-label">{{ trans('auth/student.state_of_birth') }}</label>
                                        <input type="text"
                                            class="form-control state_of_birth @error('state_of_birth') is-invalid @enderror"
                                            name="state_of_birth" value="{{ old('state_of_birth') }}"
                                            placeholder="{{ trans('auth/student.placeholder.state_of_birth') }}">
                                        @error('state_of_birth')
                                            <small class="text-danger d-block">
                                                {{ $message }}
                                            </small>
                                        @enderror
                                    </div>
                                    <div class="col-sm-12 col-md-3 mb-2">
                                        <label for="place_of_birth"
                                            class="form-label">{{ trans('auth/student.place_of_birth') }}</label>
                                        <input type="text"
                                            class="form-control place_of_birth @error('place_of_birth') is-invalid @enderror"
                                            name="place_of_birth" value="{{ old('place_of_birth') }}"
                                            placeholder="{{ trans('auth/student.placeholder.place_of_birth') }}">
                                        @error('place_of_birth')
                                            <small class="text-danger d-block">
                                                {{ $message }}
                                            </small>
                                        @enderror
                                    </div>
                                    <div class="col-12 row px-0 mx-0 mt-3 d-flex ">
                                        <div class="col-sm-12 col-md-6 d-flex justify-content-start"></div>
                                        <div class="col-sm-12 col-md-6 d-flex justify-content-end">
                                            <button type="button"
                                                class="btn btn-primary btn-next">{{ trans('auth/student.next') }}</button>
                                        </div>
                                    </div>
                                </div>
                        </fieldset>

                        <fieldset>
                            <div id="education_information">
                                <div class="row">
                                    <div class="col-sm-12 col-md-6 mb-2">
                                        <label for="registration_number"
                                            class="form-label">{{ trans('auth/student.registration_number') }}</label>
                                        <input type="text"
                                            class="form-control registration_number @error('registration_number') is-invalid @enderror"
                                            name="registration_number" value="{{ old('registration_number') }}"
                                            placeholder="{{ trans('auth/student.placeholder.registration_number') }}">
                                        @error('registration_number')
                                            <small class="text-danger d-block">
                                                {{ $message }}
                                            </small>
                                        @enderror
                                    </div>
                                    <div class="col-sm-12 col-md-6 mb-2">
                                        <label for="group"
                                            class="form-label">{{ trans('auth/student.group') }}</label>
                                        <input type="text"
                                            class="form-control group @error('group') is-invalid @enderror" name="group"
                                            value="{{ old('group') }}"
                                            placeholder="{{ trans('auth/student.placeholder.group') }}">
                                        @error('group')
                                            <small class="text-danger d-block">
                                                {{ $message }}
                                            </small>
                                        @enderror
                                    </div>
                                    <div class="f1-buttons col-12 mt-3 d-flex">
                                        <div class="col d-flex justify-content-start">
                                            <button type="button"
                                                class="btn btn-secondary btn-previous">{{ trans('auth/student.previous') }}</button>
                                        </div>
                                        <div class="col d-flex justify-content-end">
                                            <button type="button"
                                                class="btn btn-primary btn-next">{{ trans('auth/student.next') }}</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </fieldset>

                        <fieldset>
                            <div id="account_information">
                                <div class="row">
                                    <div class="col-sm-12 col-md-6 mb-2">
                                        <label for="email"
                                            class="form-label">{{ trans('auth/student.email') }}</label>
                                        <input type="text"
                                            class="form-control email @error('email') is-invalid @enderror"
                                            name="email" value="{{ old('email') }}"
                                            placeholder="{{ trans('auth/student.placeholder.email') }}">
                                        @error('email')
                                            <small class="text-danger d-block">
                                                {{ $message }}
                                            </small>
                                        @enderror
                                    </div>
                                    <div class="col-sm-12 col-md-6 mb-2">
                                        <label for="phone"
                                            class="form-label">{{ trans('auth/student.phone') }}</label>
                                        <input type="text"
                                            class="form-control phone @error('phone') is-invalid @enderror"
                                            name="phone" value="{{ old('phone') }}"
                                            placeholder="{{ trans('auth/student.placeholder.phone') }}">
                                        @error('phone')
                                            <small class="text-danger d-block">
                                                {{ $message }}
                                            </small>
                                        @enderror
                                    </div>
                                    <div class="col-sm-12 col-md-6 mb-2">
                                        <label for="password"
                                            class="form-label">{{ trans('auth/student.password') }}</label>
                                        <input type="password"
                                            class="form-control password @error('password') is-invalid @enderror"
                                            name="password">
                                        @error('password')
                                            <small class="text-danger d-block">
                                                {{ $message }}
                                            </small>
                                        @enderror
                                    </div>
                                    <div class="col-sm-12 col-md-6 mb-2">
                                        <label for="password_confirmation"
                                            class="form-label">{{ trans('auth/student.confirme_password') }}</label>
                                        <input type="password"
                                            class="form-control confirme_password @error('password_confirmation') is-invalid @enderror"
                                            name="password_confirmation">
                                        @error('password_confirmation')
                                            <small class="text-danger d-block">
                                                {{ $message }}
                                            </small>
                                        @enderror
                                    </div>
                                    <div class="f1-buttons col-12 mt-3 d-flex">
                                        <div class="col d-flex justify-content-start">
                                            <button type="button"
                                                class="btn btn-secondary btn-previous">{{ trans('auth/student.previous') }}</button>
                                        </div>
                                        <div class="col d-flex justify-content-end">
                                            <button type="button" class="btn btn-primary btn-next"
                                                id="next-review-step">{{ trans('auth/student.next') }}</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </fieldset>

                        <fieldset>
                            <div id="review_information">
                                <div class="row">
                                    <div class="col-sm-12 col-md-3 mb-2">
                                        <label for="firstname_ar"
                                            class="form-label">{{ trans('auth/student.firstname_ar') }}</label>
                                        <input type="text" class="form-control" id="firstname_ar" disabled>
                                    </div>
                                    <div class="col-sm-12 col-md-3 mb-2">
                                        <label for="lastname_ar"
                                            class="form-label">{{ trans('auth/student.lastname_ar') }}</label>
                                        <input type="text" class="form-control" id="lastname_ar" disabled>
                                    </div>
                                    <div class="col-sm-12 col-md-3 mb-2">
                                        <label for="lastname_fr"
                                            class="form-label">{{ trans('auth/student.lastname_fr') }}</label>
                                        <input type="text" class="form-control" id="lastname_fr" disabled>
                                    </div>
                                    <div class="col-sm-12 col-md-3 mb-2">
                                        <label for="firstname_fr"
                                            class="form-label">{{ trans('auth/student.firstname_fr') }}</label>
                                        <input type="text" class="form-control" id="firstname_fr" disabled>
                                    </div>
                                    <div class="col-sm-12 col-md-3 mb-2">
                                        <label for="gender"
                                            class="form-label">{{ trans('auth/student.gender') }}</label>
                                        <input type="text" class="form-control" id="gender" disabled>
                                    </div>
                                    <div class="col-sm-12 col-md-3 mb-2">
                                        <label for="birthday"
                                            class="form-label">{{ trans('auth/student.birthday') }}</label>
                                        <input type="date" class="form-control" id="birthday" disabled>
                                    </div>
                                    <div class="col-sm-12 col-md-3 mb-2">
                                        <label for="state_of_birth"
                                            class="form-label">{{ trans('auth/student.state_of_birth') }}</label>
                                        <input type="text" class="form-control" id="state_of_birth" disabled>
                                    </div>
                                    <div class="col-sm-12 col-md-3 mb-2">
                                        <label for="place_of_birth"
                                            class="form-label">{{ trans('auth/student.place_of_birth') }}</label>
                                        <input type="text" class="form-control" id="place_of_birth" disabled>
                                    </div>
                                    <div class="col-sm-12 col-md-6 mb-2">
                                        <label for="registration_number"
                                            class="form-label">{{ trans('auth/student.registration_number') }}</label>
                                        <input type="text" class="form-control" id="registration_number" disabled>
                                    </div>
                                    <div class="col-sm-12 col-md-6 mb-2">
                                        <label for="group"
                                            class="form-label">{{ trans('auth/student.group') }}</label>
                                        <input type="text" class="form-control" id="group" disabled>
                                    </div>

                                    <div class="col-sm-12 col-md-6 mb-2">
                                        <label for="email"
                                            class="form-label">{{ trans('auth/student.email') }}</label>
                                        <input type="text" class="form-control" id="email" disabled>
                                    </div>
                                    <div class="col-sm-12 col-md-6 mb-2">
                                        <label for="phone"
                                            class="form-label">{{ trans('auth/student.phone') }}</label>
                                        <input type="text" class="form-control" id="phone" disabled>
                                    </div>
                                    <div class="f1-buttons col-12 mt-3 d-flex">
                                        <div class="col d-flex justify-content-start">
                                            <button type="button"
                                                class="btn btn-secondary btn-previous">{{ trans('auth/student.previous') }}</button>
                                        </div>
                                        <div class="col d-flex justify-content-end">
                                            <button type="submit" id="btn-save"
                                                class="btn btn-primary btn-submit">{{ trans('auth/student.accept') }}</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
