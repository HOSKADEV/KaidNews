{{-- <!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register</title>
    <link rel="shortcut icon" href="{{ asset('static/img/logo2.png') }}" type="image/x-icon">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <style>
        input {
            direction: ltr
        }
    </style>
    {{-- @include('tools.header') --}}
</head>

<div class="d-flex justify-content-center align-items-center" dir="rtl" style="min-height: 100vh">
    <div class="container">
        <div class="card height-auto">
            <div class="card-body">
                <div class="heading-layout1">
                    <div class="item-title">
                        {{-- <h3>{{ __('register') }}</h3> --}}
                        <h3>{{ trans('auth.register') }}</h3>
                    </div>
                </div>
                <form class="new-added-form text-right f1" method="post" action="{{ route('auth.submit.register') }}">

                    @csrf

                    <div class="f1-steps justify-content-start  text-right">
                        <div class="f1-progress">
                            <div class="f1-progress-line" data-now-value="25" data-number-of-steps="4"
                                style="width: 25%;"></div>
                        </div>

                        <div class="f1-step active">
                            <div class="f1-step-icon">
                                <i class="fa fa-user" style="margin: 0 12px;"></i>
                            </div>
                            <p>{{ trans('auth/student.personal_information') }}</p>
                        </div>
                        <div class="f1-step">
                            <div class="f1-step-icon">
                                <i class="fa fa-graduation-cap fa-2X" style="margin: 0 10px;" aria-hidden="true"></i>
                            </div>
                            <p>{{ trans('auth/student.education_information') }}</p>
                        </div>
                        <div class="f1-step">
                            <div class="f1-step-icon">
                                <i class="fa fa-cog" style="margin: 0 13px;" aria-hidden="true"></i>
                            </div>
                            <p>{{ trans('auth/student.account_information') }}</p>
                        </div>
                        <div class="f1-step">
                            <div class="f1-step-icon">
                                <i class="fa fa-file " style="margin: 0 13px;" aria-hidden="true"></i>
                            </div>
                            <p>{{ trans('auth/student.review_information') }}</p>
                        </div>
                    </div>
                    <fieldset>
                        <div id="personal_information">
                            <div class="row text-right">
                                <div class="col-xl-3 col-lg-6 col-12 form-group">
                                    <label>{{ trans('auth/student.firstname_ar') }}</label>
                                    <input type="text" name="firstname_ar" placeholder=""
                                        class="form-control firstname_ar @error('firstname_ar') is-invalid @enderror">
                                    {{-- 
                                    @error('firstname_ar')
                                        <span class="text-red">{{ $message }}</span>
                                    @enderror 
                                    --}}
                                    @error('firstname_ar')
                                        <small class="text-danger d-block mt-1">
                                            {{ $message }}
                                        </small>
                                    @enderror
                                </div>

                                <div class="col-xl-3 col-lg-6 col-12 form-group">
                                    <label>{{ trans('auth/student.firstname_fr') }}</label>
                                    <input type="text" name="firstname_fr" placeholder=""
                                        class="form-control firstname_fr @error('firstname_fr') is-invalid @enderror">
                                    @error('firstname_fr')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-xl-3 col-lg-6 col-12 form-group">
                                    <label>{{ trans('auth/student.lastname_ar') }}</label>
                                    <input type="text" name="lastname_ar" placeholder=""
                                        class="form-control lastname_ar  @error('lastname_ar') is-invalid @enderror">
                                    @error('lastname_ar')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-xl-3 col-lg-6 col-12 form-group">
                                    <label>{{ trans('auth/student.lastname_fr') }}</label>
                                    <input type="text" name="lastname_fr" placeholder=""
                                        class="form-control lastname_fr @error('lastname_fr') is-invalid @enderror">
                                    @error('lastname_fr')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-xl-3 col-lg-6 col-12 form-group">
                                    <label>{{ trans('auth/student.gender') }}</label>
                                    <select name="gender"
                                        class="form-control gender  @error('gender') is-invalid @enderror">
                                        <option value="">{{ __('Please Select Gender') }}</option>
                                        <option value="1">{{ __('male') }}</option>
                                        <option value="2">{{ __('female') }}</option>
                                    </select>
                                    @error('gender')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-xl-3 col-lg-6 col-12 form-group">
                                    <label>{{ trans('auth/student.birthday') }}</label>
                                    <input name="birthday" type="date"
                                        class="form-control birthday  @error('birthday') is-invalid @enderror">
                                    @error('birthday')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-xl-3 col-lg-6 col-12 form-group">
                                    <label>{{ trans('auth/student.state_of_birth') }}</label>
                                    <input type="text" name="state_of_birth"
                                        class="form-control state_of_birth @error('state_of_birth') is-invalid @enderror">
                                    @error('state_of_birth')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-xl-3 col-lg-6 col-12 form-group">
                                    <label>{{ trans('auth/student.place_of_birth') }}</label>
                                    <input type="text" name="place_of_birth" placeholder=""
                                        class="form-control place_of_birth @error('place_of_birth') is-invalid @enderror">
                                    @error('place_of_birth')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-12 row px-0 mx-0">
                                    <div class="col text-left">
                                        <button type="button"
                                            class="px-0 btn btn-secondary btn-next">{{ __('Next') }}</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </fieldset>

                    <fieldset>
                        <div id="education_information">
                            <div class="row text-right">
                                <div class="col-xl-6 col-lg-6 col-12 form-group">
                                    <label>{{ __('registration_number') }}</label>
                                    <input type="text" name="registration_number" placeholder=""
                                        class="form-control registration_number">
                                    @error('registration_number')
                                        <span class="text-red">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-xl-6 col-lg-6 col-12 form-group">
                                    <label>{{ __('group') }}</label>
                                    <input type="text" name="group" placeholder="" class="form-control group">
                                    @error('group')
                                        <span class="text-red">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="f1-buttons col-12 row px-0 mx-0">
                                    <div class="col ">
                                        <button type="button" class="btn btn-previous">{{ __('Previous') }}</button>
                                    </div>
                                    <div class="col text-left">
                                        <button type="button" class="btn btn-next">{{ __('Next') }}</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </fieldset>

                    <fieldset>
                        <div id="account_information">
                            <div class="row text-right">
                                <div class="col-xl-6 col-lg-6 col-12 form-group">
                                    <label>{{ __('email') }}</label>
                                    <input type="text" name="email" placeholder="" class="form-control email">
                                    @error('email')
                                        <span class="text-red">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-xl-6 col-lg-6 col-12 form-group">
                                    <label>{{ __('phone') }}</label>
                                    <input type="text" name="phone" placeholder="" class="form-control phone">
                                    @error('phone')
                                        <span class="text-red">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-xl-6 col-lg-6 col-12 form-group">
                                    <label>{{ __('password') }}</label>
                                    <input type="text" name="password" placeholder="" class="form-control">
                                    @error('password')
                                        <span class="text-red">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-xl-6 col-lg-6 col-12 form-group">
                                    <label>{{ __('confirme_password') }}</label>
                                    <input type="text" name="password" placeholder="" class="form-control">
                                    @error('password')
                                        <span class="text-red">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="f1-buttons col-12 row px-0 mx-0">
                                    <div class="col ">
                                        <button type="button" class="btn btn-previous">{{ __('Previous') }}</button>
                                    </div>
                                    <div class="col text-left">
                                        <button type="button" class="btn btn-next"
                                            id="next-review-step">{{ __('Next') }}</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </fieldset>

                    <fieldset>
                        <div id="review_information">
                            <div class="row text-right">
                                <div class="col-xl-3 col-lg-6 col-12 form-group">
                                    <label>{{ trans('auth/student.firstname_ar') }}</label>
                                    <input type="text" id="firstname_ar" class="form-control" disabled>
                                </div>
                                <div class="col-xl-3 col-lg-6 col-12 form-group">
                                    <label>{{ trans('auth/student.firstname_fr') }}</label>
                                    <input type="text" id="firstname_fr" placeholder="" class="form-control"
                                        disabled>
                                </div>
                                <div class="col-xl-3 col-lg-6 col-12 form-group">
                                    <label>{{ trans('auth/student.lastname_ar') }}</label>
                                    <input type="text" id="lastname_ar" placeholder="" class="form-control"
                                        disabled>
                                </div>
                                <div class="col-xl-3 col-lg-6 col-12 form-group">
                                    <label>{{ trans('auth/student.lastname_fr') }}</label>
                                    <input type="text" id="lastname_fr" placeholder="" class="form-control"
                                        disabled>
                                </div>
                                <div class="col-xl-3 col-lg-6 col-12 form-group">
                                    <label>{{ trans('auth/student.gender') }}</label>
                                    <input type="text" name="gender" id="gender" placeholder=""
                                        class="form-control" disabled>
                                </div>
                                <div class="col-xl-3 col-lg-6 col-12 form-group">
                                    <label>{{ trans('auth/student.birthday') }}</label>
                                    <input name="birthday" type="date" id="birthday" placeholder="dd/mm/yyyy"
                                        class="form-control" disabled>
                                </div>
                                <div class="col-xl-3 col-lg-6 col-12 form-group">
                                    <label>{{ trans('auth/student.state_of_birth') }}</label>
                                    <input type="text" name="state_of_birth" id="state_of_birth" placeholder=""
                                        class="form-control" disabled>
                                </div>
                                <div class="col-xl-3 col-lg-6 col-12 form-group">
                                    <label>{{ trans('auth/student.place_of_birth') }}</label>
                                    <input type="text" name="place_of_birth" id="place_of_birth" placeholder=""
                                        class="form-control" disabled>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-12 form-group">
                                    <label>{{ trans('auth/student.registration_number') }}</label>
                                    <input type="text" name="registration_number" id="registration_number"
                                        placeholder="" class="form-control" disabled>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-12 form-group">
                                    <label>{{ trans('auth/student.group') }}</label>
                                    <input type="text" name="group" id="group" class="form-control"
                                        disabled>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-12 form-group">
                                    <label>{{ trans('auth/student.email') }}</label>
                                    <input type="text" name="email" id="email" class="form-control"
                                        disabled>
                                </div>

                                <div class="col-xl-6 col-lg-6 col-12 form-group">
                                    <label>{{ trans('auth/student.phone') }}</label>
                                    <input type="text" name="phone" id="phone" class="form-control"
                                        disabled>
                                </div>
                                <div class="f1-buttons col-12 row px-0 mx-0">
                                    <div class="col ">
                                        <button type="button" class="btn btn-previous">{{ __('Previous') }}</button>
                                    </div>
                                    <div class="col text-left">
                                        <button type="submit" class="btn btn-submit">{{ __('Submit') }}</button>
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



<script src="{{ asset('assets/js/retina-1.1.0.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery-1.11.1.min.js') }}"></script>
<script src="{{ asset('assets/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/js/retina-1.1.0.min.js') }}"></script>
{{-- <script src="{{ asset('static/js/ajax.js') }}"></script> --}}
<script src="{{ asset('assets/js/scripts.js') }}"></script>

<script>
    $(document).ready(function() {
        $('#personal_information .lastname_ar').on('change', function() {
            $('#review_information #lastname_ar').val($(this).val());
        });
        $('#personal_information .lastname_fr').on('change', function() {
            $('#review_information #lastname_fr').val($(this).val());
        });
        $('#personal_information .firstname_ar').on('change', function() {
            $('#review_information #firstname_ar').val($(this).val());
        });
        $('#personal_information .firstname_fr').on('change', function() {
            $('#review_information #firstname_fr').val($(this).val());
        });
        $('#personal_information .gender').on('change', function() {
            $('#review_information #gender').val($(this).val() == 1 ? 'ذكر' : 'انثى');
        });
        $('#personal_information .birthday').on('change', function() {
            $('#review_information #birthday').val($(this).val());
        });
        $('#personal_information .state_of_birth').on('change', function() {
            $('#review_information #state_of_birth').val($(this).val());
        });
        $('#personal_information .place_of_birth').on('change', function() {
            $('#review_information #place_of_birth').val($(this).val());
        });
        $('#account_information .email').on('change', function() {
            $('#review_information #email').val($(this).val());
        });
        $('#account_information .phone').on('change', function() {
            $('#review_information #phone').val($(this).val());
        });

        $('#education_information .registration_number').on('change', function() {
            $('#review_information #registration_number').val($(this).val());
        });
        $('#education_information .group').on('change', function() {
            $('#review_information #group').val($(this).val());
        });


        $('#next-review-step').on('click', function() {
            // alert("Button clicked!");
            // console.log(('#place_of_birth').value);
            // console.log(('#place_of_birth').value);
            // console.log(('#place_of_birth').value);
            // console.log(('#place_of_birth').value);
        });
        // console.log('hhhh');
        // $('.lastname_ar').on('change', function() {
        //     var lastname_ar = $('.lastname_ar').val();
        //     console.log(lastname_ar);
        //     ('#review_information #lastname_ar').val(lastname_ar);
        // })
        // $('#personal_information .lastname_ar').on('keyup', function() {
        //     var lastname_ar = $(this).val();
        //     console.log(lastname_ar);
        //     ('#review_information #lastname_ar').val(lastname_ar);
        // })
        // $('#personal_information .lastname_fr').on('keyup', function() {
        //     var lastname_fr = $(this).val();
        //     console.log(lastname_fr);
        //     ('#review_information #lastname_fr').val(lastname_fr);
        // })
        // $('#personal_information .firstname_ar').on('keyup', function() {
        //     var firstname_ar = $(this).val();
        //     console.log(firstname_ar);
        //     ('#review_information #firstname_ar').val(firstname_ar);
        // })
        // $('#personal_information .firstname_ar').on('keyup', function() {
        //     var firstname_fr = $(this).val();
        //     console.log(firstname_fr);
        //     ('#review_information #firstname_fr').val(firstname_fr);
        // })

        // $('next-review-step').on('cleck', function() {
        //     console.log("Go to Review Setp");

        //     // lastname_ar firstname_fr
        //     // ('#review_information #lastname_ar').text('مجاجي');
        //     // ('#review_information #lastname_fr').text('Medjadji');
        //     // ('#review_information #firstname_ar').text('عبدالقادر');
        //     // ('#review_information #firstname_fr').text('Abdelkadir');
        // });
        // next-review-step
    });
</script>
</body>

</html> 