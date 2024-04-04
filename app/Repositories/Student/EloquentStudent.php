<?php

namespace App\Repositories\Student;

use App\Models\Student;
use App\Repositories\Student\StudentRepository;
use App\Http\Filters\Student\StudentKeywordSearch;

class EloquentStudent implements StudentRepository
{
    /**
     * {@inheritdoc}
     */
    public function all()
    {
        return Student::all();
    }

    public function listStudentHasNotCertificate(){
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
    public function paginate($perPage, $search = null, $group = null, $status = null)
    {
        $query = Student::query()->with('evaluations','tests', 'tests.subject','certificate');

        if ($group) {
            $query->where('group', $group);
        }

        if ($search) {
            (new StudentKeywordSearch)($query, $search);
        }

        $result = $query->orderBy('id', 'desc')
            ->paginate($perPage);

        if ($search) {
            $result->appends(['search' => $search]);
        }
        return $result;
    }
}
