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
     * Get all available students.
     * @return mixed
     */
    public function listStudentHasNotCertificate();
    /**
     * Get count of students.
     * @return mixed
     */
    public function count();

    /**
     * {@inheritdoc}
     */
    public function create(array $data);

    public function findNotes($id);

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

    public function paginate($perPage,$start_date = null,$end_date = null, $search = null, $registration_number = null, $batch = null, $group = null, $status = null);


    /**
     * Print List Student.
     *
     * @param $perPage
     * @param null $search
     * @param null $status
     * @return mixed
     */

    public function listPrintStudent($search = null, $registration_number = null, $batch = null, $group = null, $status = null);
}
