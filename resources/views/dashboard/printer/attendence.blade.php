<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    {{-- <meta name="viewport" content="width=device-width, initial-scale=1.0"> --}}
    <title>{{ trans('print.title_print.attendence') }}</title>
    <style>
        /* Define your styles for the print page here */
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        .title {
            font-size: 24px;
            font-weight: bold;
            margin-top: 10px;
            /* margin: 20px auto; */
        }

        table {
            margin-top: 25px;
            width: 100%;
            border-collapse: collapse;
        }

        .table-print {
            width: 100%;
            text-align: center;
        }

        th,
        td {

            border: 1px solid #ddd;

            padding: 2px;
            /* width: 20px; */
            text-align: center;
        }

        th {
            background-color: #f2f2f2;
        }

        @page {
            margin-top: 0;
            margin-bottom: 0;

        }

        @page: first {
            margin-top: 0;
        }

        @page: first {
            margin-top: 0;
        }

        @media print {
            .no-print {
                display: none;
            }
        }
    </style>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
</head>

<body>
    <div class="header-print-page" style="margin-top: 15px">
        <div>
            <h3 class="text-center title">التربص الميداني بجريدة القائد نيوز {{ $date }}</h3>
        </div>
        <div class="row">
            <div class="col-3 text-right">
                <img style="height: 100px; width:200px" src="{{ asset('assets/logo/logo-print.jpg') }}" alt=""
                    srcset="">
            </div>
            <div class="col-6">
                <h3 class="text-center title">{{ trans('print.title.attendence') }}</h3>
                <h5 class="text-center">{{ trans('print.date_print') }} : {{ date('Y-m-d H:i') }}</h5>
                <div class="row">
                    <div class="col-6">
                        <h5 class="text-right">{{ trans('attendence.group') }} :
                            {{ $group != null ? trans('print.groups.' . $group) : trans('print.groups.all') }}</h5>
                    </div>
                    <div class="col-6">
                        <h5 class="text-left">{{ trans('attendence.month') }} :
                            {{ $month != null ? trans('attendence.months.' . $month) : trans('attendence.months.all') }}
                        </h5>
                    </div>
                    {{-- <div class="col-8">
                    <h5 class="text-right">{{ trans('print.date_print') }} : {{ date('Y-m-d H:i')}}</h5>
                </div> --}}
                </div>

            </div>
            <div class="col-3">
                <img style="height: 100px; width:200px" src="{{ asset('assets/logo/kaid-logo.png') }}" alt=""
                    srcset="">
            </div>
            {{-- <div class="col-12">
            <h5 class="text-right">{{ trans('print.date_print') }} : {{ date('Y-m-d H:i')}}</h5>
        </div> --}}
        </div>
    </div>

    <table class="table-print">
        <thead>
            <tr>
                <th>{{ trans('print.ID') }}</th>
                <th>{{ trans('evaluation.name') }}</th>
                <th>{{ trans('student.phone') }}</th>
                <th>{{ trans('student.registration_number') }}</th>
                <th>{{ trans('student.group') }}</th>
                <th colspan="{{ $days }}">{{ trans('print.weeks.1') }}</th>
                <th colspan="{{ $days }}">{{ trans('print.weeks.2') }}</th>
                <th colspan="{{ $days }}">{{ trans('print.weeks.3') }}</th>
                <th colspan="{{ $days }}">{{ trans('print.weeks.4') }}</th>
            </tr>
        </thead>
        <tbody>
            @if (count($students))


                @foreach ($students as $key => $student)
                    <tr>
                        <th>{{ $loop->iteration }}</th>
                        <td>{{ $student->name }}</td>
                        <td>{{ $student->phone }}</td>
                        <td>{{ $student->registration_number }}</td>
                        <td>{{ trans('print.groups.' . $student->group) }}</td>
                        @for ($i = 1; $i < 5; $i++)
                            @for ($day = 1; $day <= $days; $day++)
                                <td class="text-center" style="width: 30px">
                                    @if (count($student->attendences->where('week', $i)->where('month', $month)->where('year', $year)->where('day', $day)->where('number', '!=', 0)) > 0)
                                        @php
                                            $numbers = $student->attendences->where('week', $i)->where('month', $month)->where('year', $year)->where('day', $day);
                                        @endphp
                                        @foreach ($numbers as $number)
                                        @switch($number->number)
                                          @case(3)
                                            <div class="d-flex">
                                                <span class="border border-secondary p-1">x</span>
                                                <span class="border border-secondary p-1">x</span>
                                                <span class="border border-secondary p-1">x</span>
                                            </div>
                                            @break
                                          @case(2)
                                            <div class="d-flex">
                                                <span class="border border-secondary p-1">x</span>
                                                <span class="border border-secondary p-1">x</span>
                                                <span class="border border-secondary p-1">.</span>
                                            </div>
                                            @break
                                          @case(1)
                                            <div class="d-flex">
                                                <span class="border border-secondary p-1">x</span>
                                                <span class="border border-secondary p-1">.</span>
                                                <span class="border border-secondary p-1">.</span>
                                            </div>
                                            @break

                                          @default
                                          <div class="d-flex">
                                            <span class="border border-secondary p-1"></span>
                                            <span class="border border-secondary p-1"></span>
                                            <span class="border border-secondary p-1"></span>
                                          </div>
                                        @endswitch
                                        @endforeach
                                    @endif
                                </td>
                            @endfor
                        @endfor
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="11"><em>@lang('لا يوجد سجلات.')</em></td>
                </tr>
            @endif
        </tbody>
    </table>
    <script>
        window.print();
    </script>

    <script>
        // JavaScript to remove the print page link
        window.onload = function() {
            var links = document.getElementsByTagName("a");
            for (var i = 0; i < links.length; i++) {
                if (links[i].getAttribute("href") === "javascript:window.print()") {
                    links[i].parentNode.removeChild(links[i]);
                    break;
                }
            }
        };
    </script>

</body>

</html>
