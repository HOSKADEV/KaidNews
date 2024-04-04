<?php

namespace App\Repositories\Note;

interface NoteRepository
{
    /**
     * Get all available Admin.
     * @return mixed
     */
    public function all();

    /**
     * Get count of admins.
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
     * Paginate Admin.
     *
     * @param $perPage
     * @param null $search
     * @param null $status
     * @return mixed
     */
    public function paginate($perPage, $search = null, $status = null);
}
