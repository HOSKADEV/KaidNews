<?php

namespace App\Repositories\Student;

use App\Models\Student;
use App\Http\Filters\Student\FiltersByRank;
use App\Repositories\Student\StudentRepository;
use App\Http\Filters\Student\StudentKeywordSearch;
use App\Http\Filters\Student\FiltersGoldenPassport;
use App\Http\Filters\Student\StudentKeywordBetweenDate;

class EloquentStudent implements StudentRepository
{
    /**
     * {@inheritdoc}
     */
    public function all()
    {
        return Student::all();
    }

    public function listStudentHasNotCertificate()
    {
        return Student::doesntHave('certificate')->get();
    }
    /**
     * {@inheritdoc}
     */
    public function count()
    {
        return Student::count();
    }

    /**
     * {@inheritdoc}
     */
    public function find($id)
    {
        return Student::with('notes')->find($id);
    }


    public function findNotes($id)
    {
        return Student::with('tests', 'tests.subject')->find($id);
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function create(array $data)
    {
        $student = Student::create($data);

        return $student;
    }

    /**
     * {@inheritdoc}
     */
    public function update($id, array $data)
    {
        $student = $this->find($id);

        $student->update($data);

        return $student;
    }

    /**
     * {@inheritdoc}
     */
    public function delete($id)
    {
        $student = $this->find($id);

        return $student->delete();
    }

    /**
     * @param $perPage
     * @param null $status
     * @param null $searchFrom
     * @param $searchTo
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator|mixed
     */

    public function paginate($perPage, $year = null, $start_date = null, $end_date = null, $search = null, $registration_number = null, $batch = null, $group = null,$rank = null,$passport = null, $status = null)
    {
        $query = Student::query()->with('evaluations', 'tests', 'tests.subject', 'certificate')->orderByDesc('moyenFinal');

        if ($rank) {
           (new FiltersByRank)($query, $rank);
        }

        if ($passport == 1) {
            (new FiltersGoldenPassport)($query, $passport);
        }

        // FiltersGoldenPassport
        if ($year) {
            $query->whereYear('start_date', $year);
        }
        if ($group) {
            $query->where('group', $group);
        }
        if ($registration_number) {
            $query->where('registration_number', $registration_number);
        }
        if ($batch) {
            $query->where('batch', $batch);
        }

        if ($search) {
            (new StudentKeywordSearch)($query, $search);
        }
        if ($start_date && $end_date) {
            (new StudentKeywordBetweenDate)($query, $start_date, $end_date);
        }

        // $result = $query->orderBy('id', 'desc')
        //     ->paginate($perPage);
        


        $result = $query->paginate($perPage);
            // $result= $query->orderBy(function ($query) {
            //     // Replace 'fake_column' with the name of your fake column
            //     return $query->moyen;
            // });

        if ($search) {
            $result->appends(['search' => $search]);
        }
        return $result;
    }


    /**
     * @param null $search
     * @param null $registration_number
     * @param null $batch
     * @param null $group
     * @param null $status
     */
    public function listPrintStudent($search = null, $registration_number = null, $batch = null, $group = null, $status = null)
    {
        $query = Student::query()->with('evaluations', 'tests', 'tests.subject', 'certificate');

        if ($group) {
            $query->where('group', $group);
        }
        if ($registration_number) {
            $query->where('registration_number', $registration_number);
        }
        if ($batch) {
            $query->where('batch', $batch);
        }

        if ($search) {
            (new StudentKeywordSearch)($query, $search);
        }

        $result = $query->orderBy('group', 'desc')
            ->get();

        // if ($search) {
        //     $result->appends(['search' => $search]);
        // }
        return $result;
    }
}
