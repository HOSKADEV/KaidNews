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
            <div class="card">
                <h5 class="card-header">
                    <div class="d-flex justify-content-between">
                        <div class="">
                            {{ trans('app.review') }}
                        </div>
                        <div class="">
                            @if ($account->tests->count() > 0)
                                <button target="_blank" id="downloadReview"
                                    data-url="{{ route('download.review', [
                                        'student_id' => $account->id,
                                    ]) }}"
                                    class="btn btn-primary text-white">
                                    <span class="bx bxs-download"></span>&nbsp; {{ trans('app.download_review') }}
                                </button>
                                {{-- <button target="_blank" id="downloadCertificate"
                                    data-url="{{ route('download.certificate', [
                                        'student_id' => $account->id,
                                    ]) }}"
                                    class="btn btn-primary text-white"
                                >
                                    <span class="bx bxs-download"></span>&nbsp; {{ trans('app.download_certificate') }}
                                </button>  --}}

                                <a target="_blank"
                                    href="{{ route('download.certificate', [
                                        'student_id' => $account->id,
                                    ]) }}"
                                    class="btn btn-primary text-white">
                                    <span class="bx bxs-download"></span>&nbsp; {{ trans('app.download_certificate') }}
                                </a>
                            @endif
                        </div>
                    </div>
                </h5>
                <hr class="my-0">
                <div class="card-body pt-0">
                    <div class="card-body">
                        <label for="" class="form-label">{{ trans('evaluation.date_stage') }} :
                            {{ date('d-m-Y', strtotime($account->start_date)) }} {{ trans('evaluation.to') }}
                            {{ date('d-m-Y', strtotime($account->end_date)) }}
                        </label>
                        <br>
                        <label for="" class="form-label">{{ trans('evaluation.first_name_last_name') }} :
                            {{ $account->name }}</label> <br>
                        <label for="" class="form-label">{{ trans('evaluation.birthday_state_of_birth') }} :
                            {{ date('d-m-Y', strtotime($account->birthday)) }} {{ $account->state_of_birth }}
                        </label>
                        <div class="row px-4 pb-3">
                          <div class="form-group col-md-3" dir="{{ config('app.locale') == 'ar' ? 'rtl' : 'ltr' }}">
                              <label for="rank" class="form-label">{{ trans('evaluation.label.rank') }}</label>
                              @if (!empty($evaluationExists))
                                @switch($evaluationExists->rank)
                                  @case(0)
                                    <input type="text" class="form-control" value="{{ trans('app.Norank') }}" disabled>
                                    @break
                                  @case(1)
                                    <input type="text" class="form-control" value="{{ trans('evaluation.select.rank1') }}" disabled>
                                    @break
                                  @case(2)
                                    <input type="text" class="form-control" value="{{ trans('evaluation.select.rank2') }}" disabled>
                                    @break
                                  @case(3)
                                    <input type="text" class="form-control" value="{{ trans('evaluation.select.rank3') }}" disabled>
                                    @break
                                  @default
                                    <input type="text" class="form-control" value="{{ trans('app.Norank') }}" disabled>
                                @endswitch
                              @else
                                <input type="text" class="form-control" value="{{ trans('app.Norank') }}" disabled>
                              @endif
                          </div>
                          <div class="form-group col-md-3" dir="{{ config('app.locale') == 'ar' ? 'rtl' : 'ltr' }}">
                              <label for="golden_passport" class="form-label">{{ trans('evaluation.label.golden_passport') }}</label>
                              @if (!empty($evaluationExists))
                                @switch($evaluationExists->golden_passport)
                                  @case(0)
                                    <input type="text" class="form-control" value="{{ trans('evaluation.select.golden_passport_no') }}" disabled>
                                    @break
                                  @case(1)
                                    <input type="text" class="form-control" value="{{ trans('evaluation.select.golden_passport_yes') }}" disabled>
                                    @break
                                  @default
                                    <input type="text" class="form-control" value="{{ trans('evaluation.select.golden_passport_no') }}" disabled>
                                @endswitch
                              @endif
                          </div>
                        </div>
                        @if ($account->tests->count() > 0)
                            <div class="table-responsive text-nowrap">
                                <table class="table">
                                    <thead>
                                        <tr class="text-nowrap">
                                            <th>{{ trans('evaluation.subject_name') }}</th>
                                            <th>{{ trans('subject.coef') }}</th>
                                            <th>{{ trans('evaluation.rate') }}</th>
                                            <th>{{ trans('evaluation.total_marks') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($account->tests as $key => $test)
                                            <tr>
                                                {{-- <th scope="row">{{ $loop->iteration }}</th> --}}
                                                <td>{{ $test->subject->name }}</td>
                                                <td>{{ $test->subject->coef }}</td>
                                                <td>{{ $test->rate }}</td>
                                                <td>{{ $test->result }}</td>
                                            </tr>
                                        @endforeach
                                        <tr>
                                            {{-- <td></td> --}}
                                            <td>{{ trans('evaluation.total_coef') }}</td>
                                            <td>{{ $account->total_coef }}</td>
                                            <td></td>
                                            <td>{{ $account->note }}</td>
                                        </tr>
                                        <tr>
                                            {{-- <td></td> --}}
                                            <td></td>
                                            <td></td>
                                            <td>{{ trans('evaluation.moyen') }}</td>
                                            <td>{{ number_format($account->moyen, 2) }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <h4 class="text-danger">لا يوجد اي تقييمات لحد الساعة </h4>
                        @endif

                        @if ($account->tests->count() > 0)
                            {{-- <form action="{{ route('student.notes.store') }}" method="post"> --}}
                            <form action="{{ route('student.notes.store') }}" method="POST">
                                @method('POST')
                                @csrf
                                <div class="row mt-4">
                                    {{-- <input type="hidden" > --}}
                                    <h5 class="card-header">{{ trans('evaluation.student_evaluation') }} : <span
                                            class="form-text text-danger">{{ trans('evaluation.alert') }}</span></h5>
                                    <div class="col-sm-12 col-md-12 mb-2">
                                        <textarea class="form-control" @if ($account->notes) disabled @endif name="note"
                                            id="exampleFormControlTextarea1" rows="3">{{ $account->notes !== null ? $account->notes->note : ''; }}</textarea>
                                        @error('note')
                                            <small class="text-danger d-block mt-1">
                                                {{ $message }}
                                            </small>
                                        @enderror
                                    </div>
                                    @if ($account->notes == null)

                                    <div class="col-sm-12 col-md-6 mb-0">
                                        <button type="submit"
                                            class="btn btn-primary me-2">{{ trans('app.save') }}</button>
                                    </div>
                                    @endif
                                </div>
                            </form>
                        @endif
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
            });


            $("#downloadCertificate").click(function(e) {
                let url = $(this).attr('data-url');
                var printWindow = window.open(url, '_blank', 'height=auto,width=auto');
                printWindow.print();
            });

            $("#downloadReview").click(function(e) {
                let url = $(this).attr('data-url');
                var printWindow = window.open(url, '_blank', 'height=auto,width=auto');
                printWindow.print();
            });
        });
    </script>
@endsection
