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
    <div class="header-print-page" style="margin-top: 15px">
        <div class="row">
            <div class="col-3 text-right">
                <img style="height: 100px; width:200px" src="{{ asset('assets/logo/logo-print.jpg') }}" alt=""
                    srcset="">
            </div>
            <div class="col-6">
                <h3 class="text-center title">{{ trans('print.title.students') }}</h3>
                <h5 class="text-center">{{ trans('print.date_print') }} : {{ date('Y-m-d H:i') }}</h5>

                <h5 class="text-center">{{ trans('print.batch') }} :
                    {{ $batch != null ? trans('print.batchs.' . $batch) : trans('print.batchs.all') }}</h5>

                <h5 class="text-center">{{ trans('print.group') }} :
                    {{ $group != null ? trans('print.groups.' . $group) : trans('print.groups.all') }}</h5>

            </div>
            <div class="col-3">
                <img style="height: 100px; width:200px" src="{{ asset('assets/logo/kaid-logo.png') }}" alt=""
                    srcset="">
            </div>
        </div>
    </div>

    <table class="table mb-2">
      <thead>
          <tr class="text-nowrap">
              <th>#</th>
              <th>{{ trans('evaluation.name') }}</th>
              <th>{{ trans('student.birthday') }}</th>
              <th>{{ trans('student.gender') }}</th>
              <th>{{ trans('student.registration_number') }}</th>
              <th>{{ trans('student.group') }}</th>
              <th>{{ trans('evaluation.moyen') }}</th>
          </tr>
      </thead>
      <tbody>
          @if (count($students))
              @foreach ($students as $key => $student)
                  @php
                      $rowNumber = ($students->currentPage() - 1) * $students->perPage() + $loop->index + 1;
                  @endphp
                  <tr>
                      <th scope="row">{{ $rowNumber }}</th>
                      <td>{{ $student->name }}</td>
                      <td>{{ $student->birthday }}</td>
                      <td>{{ $student->gender == 1 ? trans('student.male') : trans('student.female') }}</td>
                      <td>{{ $student->registration_number }}</td>
                      <td>{{ $student->group }}</td>
                      <td class="text-center">
                          {{ $student->tests->count() > 0 ? number_format($student->moyen, 2) : 'لم يتم تقييم بعد' }}
                          @if ($student->evaluations)
                              @if ($student->evaluations->rank != 0)
                                <img src="{{ asset('assets/prize/' . $student->evaluations->rank . '.svg') }}"
                                width="30px" height="30px" alt="" srcset="">
                              @endif
                              @if ($student->evaluations->golden_passport == 1)
                                  <img src="{{ asset('assets/prize/reward.png') }}" width="30px"
                                      height="30px" alt="" srcset="">
                              @endif
                          @endif
                      </td>
                  </tr>
              @endforeach
          @else
              <tr>
                  <td colspan="9"><em>@lang('لا يوجد سجلات.')</em></td>
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
