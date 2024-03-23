@extends('layouts/contentNavbarLayout')

@section('title', trans('evaluation.title'))

@section('page-script')
    <script src="{{ asset('assets/js/pages-account-settings-account.js') }}"></script>
@endsection

@section('content')
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">{{ trans('evaluation.dashboard') }} /</span> {{ trans('evaluation.evaluations') }}
    </h4>
    <div class="card">
        <div class="table-responsive text-nowrap">
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
                        <th>{{ trans('app.actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($students as $key => $student)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $student->name }}</td>
                            <td>{{ $student->birthday }}</td>
                            <td>{{ $student->gender == 1 ? trans('student.male') : trans('student.female') }}</td>
                            <td>{{ $student->registration_number }}</td>
                            <td>{{ $student->group }}</td>
                            <td class="text-center">
                                {{ $student->tests->count() > 0 ? number_format($student->moyen, 2) : 'لم يتم تقييم بعد' }}
                            </td>

                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                        data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
                                    <div class="dropdown-menu">
                                        @if ($student->tests->count() == 0)
                                            <a class="dropdown-item"
                                                href="{{ route('dashboard.evaluations.create', $student->id) }}">
                                                <i class="bx bx-edit-alt me-2"></i>
                                                {{ trans('evaluation.create') }}
                                            </a>
                                        @else
                                            <button target="_blank" id="printSection"
                                                data-url="{{ route('dashboard.print.attendence', [
                                                    'group' => Request::get('group'),
                                                    'month' => Request::get('month'),
                                                ]) }}"
                                                class="dropdown-item">
                                                <i class="bx bxs-printer me-2"></i>
                                                {{ trans('app.print') }}
                                            </button>
                                        @endif
                                        <a class="dropdown-item"
                                            href="{{ route('dashboard.evaluations.show', $student->id) }}">
                                            <i class="bx bx-show me-2"></i>
                                            {{ trans('evaluation.show') }}
                                        </a>




                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $students->links() }}
        </div>
    </div>
@endsection
