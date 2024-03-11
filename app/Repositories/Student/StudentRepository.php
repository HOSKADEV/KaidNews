<?php

namespace App\Repositories\Student;

interface StudentRepository
{
    /**
     * Get all available students.
     * @return mixed
     */
    public function all();

    /**
     * Get count of students.
     * @return mixed
     */
    public function count();
    
    /**
     * {@inheritdoc}
     */
    public function create(array $data);

    /**
     * {@inheritdoc}
     */
    public function update($id, array $data);

    /**
     * {@inheritdoc}
     */
    public function delete($id);

    /**
     * Paginate Student.
     *
     * @param $perPage
     * @param null $search
     * @param null $status
     * @return mixed
     */
    public function paginate($perPage, $search = null, $status = null);
}
