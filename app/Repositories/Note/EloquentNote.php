<?php

namespace App\Repositories\Note;

use App\Models\Note;
use App\Repositories\Note\NoteRepository;

class EloquentNote implements NoteRepository
{
    /**
     * {@inheritdoc}
     */
    public function all()
    {
        return Note::all();
    }

    /**
     * {@inheritdoc}
     */
    public function count()
    {
        return Note::count();
    }

    /**
     * {@inheritdoc}
     */
    public function find($id)
    {
        return Note::find($id);
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function create(array $data)
    {
        $note = Note::create($data);

        return $note;
    }

    /**
     * {@inheritdoc}
     */
    public function update($id, array $data)
    {
        $note = $this->find($id);

        $note->update($data);

        return $note;
    }

    /**
     * {@inheritdoc}
     */
    public function delete($id)
    {
        $note = $this->find($id);

        return $note->delete();
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
        $query = Note::query();

        // if ($status) {
        //     $query->where('status', $status);
        // }

        if ($search) {
            (new AdminKeywordSearch)($query, $search);
        }

        $result = $query->orderBy('id', 'desc')
            ->paginate($perPage);

        if ($search) {
            $result->appends(['search' => $search]);
        }
        return $result;
    }
}
