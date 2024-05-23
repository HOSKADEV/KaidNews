<?php

namespace App\Repositories\SituationalExpnses;

use App\Models\SituationalExpnses;
use App\Repositories\SituationalExpnses\SituationalExpnsesRepository;

class EloquentSituationalExpnses implements SituationalExpnsesRepository
{
    /**
     * {@inheritdoc}
     */
    public function all()
    {
        return SituationalExpnses::all();
    }

    /**
     * {@inheritdoc}
     */
    public function count(){
        return SituationalExpnses::count();
    }

    /**
     * {@inheritdoc}
     */
    public function find($id)
    {
        return SituationalExpnses::find($id);
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function create(array $data)
    {
        $SituationalExpnses = SituationalExpnses::create($data);

        return $SituationalExpnses;
    }

    /**
     * {@inheritdoc}
     */
    public function update($id, array $data)
    {
        $SituationalExpnses = $this->find($id);

        $SituationalExpnses->update($data);

        return $SituationalExpnses;
    }

    /**
     * {@inheritdoc}
     */
    public function delete($id)
    {
        $SituationalExpnses = $this->find($id);

        return $SituationalExpnses->delete();
    }

    /**
     * @param $perPage
     * @param null $status
     * @param null $searchFrom
     * @param $searchTo
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator|mixed
     */
    public function paginate($perPage, $month = null, $year = null)
    {
        $query = SituationalExpnses::query();

        if ($month) {
            $query->where('month', $month);
        }

        if ($year) {
            $query->where('year', $year);
        }

        $result = $query->orderBy('id', 'desc')
            ->paginate($perPage);

        return $result;
    }
}
