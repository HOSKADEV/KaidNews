<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    {{-- <meta name="viewport" content="width=device-width, initial-scale=1.0"> --}}
    <title>{{ trans('print.title_print.teachers') }}</title>
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
        <div class="row">
            <div class="col-3 text-right">
                <img style="height: 100px; width:200px" src="{{ asset('assets/logo/logo-print.jpg') }}" alt=""
                    srcset="">
            </div>
            <div class="col-6">
                <h3 class="text-center title">{{ trans('print.title.teachers') }}</h3>
                <h5 class="text-center">{{ trans('print.date_print') }} : {{ date('Y-m-d H:i') }}</h5>

            </div>
            <div class="col-3">
                <img style="height: 100px; width:200px" src="{{ asset('assets/logo/kaid-logo.png') }}" alt=""
                    srcset="">
            </div>
        </div>
    </div>

    <table class="table-print">
        <thead>
            <tr>
                <th>ID</th>
                <th>{{ trans('student.lastname') }}</th>
                <th>{{ trans('student.firstname') }}</th>
                <th>{{ trans('teacher.email') }}</th>
                <th>{{ trans('teacher.phone') }}</th>
                <th>{{ trans('teacher.birthday') }}</th>
                <th>{{ trans('teacher.gender') }}</th>
            </tr>
        </thead>
        <tbody>
            @if (count($teachers))
                @foreach ($teachers as $key => $teacher)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $teacher->lastname_ar }}</td>
                        <td>{{ $teacher->firstname_ar }}</td>
                        <td>{{ $teacher->email }}</td>
                        <td>{{ $teacher->phone }}</td>
                        <td>{{ $teacher->birthday }}</td>
                        <td>{{ $teacher->gender == 1 ? trans('teacher.male') : trans('teacher.female') }}</td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="6"><em>@lang('لا يوجد سجلات.')</em></td>
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
