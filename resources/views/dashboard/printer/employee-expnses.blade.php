<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    {{-- <meta name="viewport" content="width=device-width, initial-scale=1.0"> --}}
    <title>{{ trans('print.title_print.students') }}</title>
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
    <div class="header-print-page" style="margin-top: 15px; margin-bottom: 100px">
        <div class="row">
            <div class="col-4 text-right">
                <img style="height: 100px; width:200px" src="{{ asset('assets/logo/logo-print.jpg') }}" alt=""
                    srcset="">
            </div>
            <div class="col-4">
                <h3 class="text-center title">التربص الميداني بجريدة القائد نيوز {{ $year }}</h3>
            </div>
            <div class="col-4">
                <img style="height: 100px; width:200px" src="{{ asset('assets/logo/kaid-logo.png') }}" alt=""
                    srcset="">
            </div>
        </div>
    </div>
    <div class="m-5 p-5">
      <table class="table mb-2">
        <thead>
            <tr class="text-nowrap">
                <th>#</th>
                <th>{{ trans('expense.Name Job') }}</th>
                <th>{{ trans('expense.First Name & Last Name') }}</th>
                <th>{{ trans('expense.Outflows') }}</th>
                <th>{{ trans('expense.Notes') }}</th>
            </tr>
        </thead>
        <tbody>
          @php
          $total = 0;
        @endphp
        @if (count($employees))
          @foreach ($employees as $employee)
            @php
              $total += $employee->amount;
            @endphp
            <tr>
              <td>{{ $loop->index +1 }}</td>
              <td>{{ $employee->typeExpenses->name }}</td>
              <td>{{ $employee->name }}</td>
              <td>{{ number_format($employee->amount,2,'.',','). ' دج' }}</td>
              <td>{{ $employee->notes }}</td>
            </tr>
          @endforeach
          <tr>
            <td></td>
            <td colspan="2">{{  trans('expense.Total workers salaries') }}</td>
            <td>{{ number_format($total,2,'.',','). ' دج'  }}</td>
          </tr>
        @else
          <tr>
              <td colspan="6"><em>@lang('لا يوجد سجلات.')</em></td>
          </tr>
        @endif
        </tbody>
      </table>
    </div>

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
