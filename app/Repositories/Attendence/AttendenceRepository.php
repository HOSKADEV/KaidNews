<?php

namespace App\Repositories\Attendence;

interface AttendenceRepository
{
    /**
     * Get all available Attendences.
     * @return mixed
     */
    public function all();

    public function findAttendence($student_id ,$year,$month,$week,$day);
    /**
     * {@inheritdoc}
     */
    public function create(array $data);

    /**
     * {@inheritdoc}
     */
    public function update($id, array $data);

        /**
     * @param $student_id
     * @param $day
     * @param $week
     * @param $month
     * @param $year

     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator|mixed
     */
    public function deleteAttendence($student_id, $day, $week, $month, $year);

    
    /**
     * {@inheritdoc}
     */
    public function delete($id);

    /**
     * Paginate Attendence.
     *
     * @param $perPage
     * @param null $search
     * @param null $status
     * @return mixed
     */
    public function paginate($perPage, $search = null, $status = null);
}
