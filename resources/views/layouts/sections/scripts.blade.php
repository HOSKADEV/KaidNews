<!-- BEGIN: Vendor JS-->
<script src="{{ asset(mix('assets/vendor/libs/jquery/jquery.js')) }}"></script>
<script src="{{ asset(mix('assets/vendor/libs/popper/popper.js')) }}"></script>
<script src="{{ asset(mix('assets/vendor/js/bootstrap.js')) }}"></script>
<script src="{{ asset(mix('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js')) }}"></script>
<script src="{{ asset(mix('assets/vendor/js/menu.js')) }}"></script>

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
@yield('vendor-script')
<!-- END: Page Vendor JS-->
<!-- BEGIN: Theme JS-->
<script src="{{ asset(mix('assets/js/main.js')) }}"></script>

<!-- END: Theme JS-->
<!-- Pricing Modal JS-->
@stack('pricing-script')
<!-- END: Pricing Modal JS-->
<!-- BEGIN: Page JS-->
@yield('page-script')
<!-- END: Page JS-->
