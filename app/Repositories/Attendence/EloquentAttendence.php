<?php

namespace App\Repositories\Attendence;

use App\Models\Attendence;

use App\Http\Filters\Student\StudentKeywordSearch;
use App\Repositories\Attendence\AttendenceRepository;


class EloquentAttendence implements AttendenceRepository
{
    /**
     * {@inheritdoc}
     */
    public function all()
    {
        return Attendence::all();
    }
    public function findAttendence($student_id ,$year,$month,$week,$day){
        $attendence = Attendence::where('student_id',$student_id)
        ->where('year',$year)
        ->where('month',$month)
        ->where('week',$week)
        ->where('day',$day)
        ->first();
        return $attendence;
    }

    /**
     * {@inheritdoc}
     */
    public function find($id)
    {
        return Attendence::find($id);
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function create(array $data)
    {
        $attendence = Attendence::create($data);

        return $attendence;
    }

    /**
     * {@inheritdoc}
     */
    public function update($id, array $data)
    {
        $attendence = $this->find($id);

        $attendence->update($data);

        return $attendence;
    }

    /**
     * @param $student_id
     * @param $day
     * @param $week
     * @param $month
     * @param $year

     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator|mixed
     */
    public function deleteAttendence($student_id, $day, $week, $month, $year)
    {
        $attendence = Attendence::where('student_id', $student_id)
            ->where('day', $day)
            ->where('week', $week)
            ->where('month', $month)
            ->where('year', $year)
            ->delete();
    }
    /**
     * {@inheritdoc}
     */
    public function delete($id)
    {
        $attendence = $this->find($id);

        return $attendence->delete();
    }

    /**
     * @param $perPage
     * @param null $status
     * @param null $searchFrom
     * @param $searchTo
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator|mixed
     */
    public function paginate($perPage, $search = null, $status = null)
    {

        $query = Attendence::query()->with('student');

        // if ($status) {
        //     $query->where('status', $status);
        // }

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
