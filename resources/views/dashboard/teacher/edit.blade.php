@extends('layouts/contentNavbarLayout')

@section('title', trans('teacher.edit'))

@section('page-script')
    <script src="{{ asset('assets/js/pages-account-settings-account.js') }}"></script>
@endsection

@section('content')
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">{{ trans('teacher.dashboard') }} / {{ trans('teacher.teachers') }}/ </span>
        {{ trans('teacher.edit') }}
    </h4>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ trans('teacher.edit') }}</h5>
            <form method="post" action="{{ route('dashboard.teachers.update', 'test') }}">
                @method('PUT')
                @csrf
                <input type="hidden" name="id" value="{{ $teacher->id }}">
                <div class="row ">
                    <div class="col-sm-12 col-md-3 mb-2 ">
                        <label for="firstname_ar"
                            class="form-label text-end">{{ trans('teacher.firstname_ar') }}</label>
                        <input type="text" class="form-control @error('firstname_ar') is-invalid @enderror"
                            name="firstname_ar" value="{{ $teacher->firstname_ar }}"
                            placeholder="{{ trans('teacher.placeholder.firstname_ar') }}">
                        @error('firstname_ar')
                            <small class="text-danger d-block mt-1">
                                {{ $message }}
                            </small>
                        @enderror
                    </div>
                    <div class="col-sm-12 col-md-3 mb-2">
                        <label for="lastname_ar" class="form-label">{{ trans('teacher.lastname_ar') }}</label>
                        <input type="text" class="form-control @error('lastname_ar') is-invalid @enderror"
                            name="lastname_ar" value="{{ $teacher->lastname_ar}}"
                            placeholder="{{ trans('teacher.placeholder.lastname_ar') }}">
                        @error('lastname_ar')
                            <small class="text-danger d-block">
                                {{ $message }}
                            </small>
                        @enderror
                    </div>
                    <div class="col-sm-12 col-md-3 mb-2">
                        <label for="firstname_fr" class="form-label">{{ trans('teacher.firstname_fr') }}</label>
                        <input type="text" class="form-control @error('firstname_fr') is-invalid @enderror"
                            name="firstname_fr" dir="ltr" value="{{ $teacher->firstname_fr }}"
                            placeholder="{{ trans('teacher.placeholder.firstname_fr') }}">
                        @error('firstname_fr')
                            <small class="text-danger d-block">
                                {{ $message }}
                            </small>
                        @enderror
                    </div>
                    <div class="col-sm-12 col-md-3 mb-2">
                        <label for="lastname_fr" class="form-label">{{ trans('teacher.lastname_fr') }}</label>
                        <input type="text" dir="ltr" class="form-control @error('lastname_fr') is-invalid @enderror"
                            name="lastname_fr" value="{{ $teacher->lastname_fr }}"
                            placeholder="{{ trans('teacher.placeholder.lastname_fr') }}">
                        @error('lastname_fr')
                            <small class="text-danger d-block">
                                {{ $message }}
                            </small>
                        @enderror
                    </div>
                    <div class="col-sm-12 col-md-3 mb-2">
                        <label for="gender" class="form-label">{{ trans('app.label.gender') }}</label>
                        <select class="form-select @error('gender') is-invalid @enderror"
                            name="gender"value="{{ $teacher->gender }}">
                            <option value="1" {{ $teacher->gender == 1 ? 'selected' : '' }}>{{ trans('app.male') }}</option>
                            <option value="2" {{ $teacher->gender == 2 ? 'selected' : '' }}>{{ trans('app.female') }}</option>
                        </select>
                        @error('gender')
                            <small class="text-danger d-block">
                                {{ $message }}
                            </small>
                        @enderror
                    </div>
                    <div class="col-sm-12 col-md-3 mb-2">
                        <label for="birthday" class="form-label">{{ trans('app.label.birthday') }}</label>
                        <input type="date" class="form-control @error('birthday') is-invalid @enderror" name="birthday"
                            value="{{ $teacher->birthday }}">
                        @error('birthday')
                            <small class="text-danger d-block">
                                {{ $message }}
                            </small>
                        @enderror
                    </div>
                   
                    <div class="col-sm-12 col-md-6 mb-2">
                        <label for="address" class="form-label">{{ trans('app.label.address') }}</label>
                        <input type="text" class="form-control @error('address') is-invalid @enderror" name="email"
                            value="{{ $teacher->address }}" placeholder="{{ trans('app.placeholder.address') }}">
                        @error('address')
                            <small class="text-danger d-block">
                                {{ $message }}
                            </small>
                        @enderror
                    </div>
                    <div class="col-sm-12 col-md-6 mb-2">
                        <label for="email" class="form-label">{{ trans('app.label.email') }}</label>
                        <input type="text" class="form-control @error('email') is-invalid @enderror" name="email"
                            value="{{ $teacher->email }}" placeholder="{{ trans('app.placeholder.email') }}">
                        @error('email')
                            <small class="text-danger d-block">
                                {{ $message }}
                            </small>
                        @enderror
                    </div>
                    <div class="col-sm-12 col-md-6 mb-2">
                        <label for="phone" class="form-label">{{ trans('app.label.phone') }}</label>
                        <input type="text" class="form-control @error('phone') is-invalid @enderror" name="phone"
                            value="{{ $teacher->phone }}" placeholder="{{ trans('app.placeholder.phone') }}">
                        @error('phone')
                            <small class="text-danger d-block">
                                {{ $message }}
                            </small>
                        @enderror
                    </div>
                    <div class="col-sm-12 col-md-6 mb-2">
                        <label for="password" class="form-label">{{ trans('app.label.password') }}</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror"
                            name="password">
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
                            <button type="submit" class="btn btn-primary">{{ trans('app.update') }}</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
