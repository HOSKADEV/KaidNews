<?php

namespace App\Repositories\Evaluation;

interface EvaluationRepository
{
    /**
     * Get all available Evaluations.
     * @return mixed
     */
    public function all();

    /**
     * {@inheritdoc}
     */
    public function create(array $data);

    /**
     * {@inheritdoc}
     */
    public function getByStudent($id);


    /**
     * {@inheritdoc}
     */
    public function update($id, array $data);

    /**
     * {@inheritdoc}
     */
    public function delete($id);

    /**
     * Paginate Evaluation.
     *
     * @param $perPage
     * @param null $search
     * @param null $status
     * @return mixed
     */
    public function paginate($perPage, $search = null, $status = null);
}
