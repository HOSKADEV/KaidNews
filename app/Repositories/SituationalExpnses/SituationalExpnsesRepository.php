<?php

namespace App\Repositories\SituationalExpnses;

interface SituationalExpnsesRepository
{
    /**
     * Get all available teachers.
     * @return mixed
     */
    public function all();

    /**
     * Get count of teachers.
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
     * Paginate Teacher.
     *
     * @param $perPage
     * @param null $search
     * @param null $status
     * @return mixed
     */
    public function paginate($perPage, $month = null, $year = null);
}
