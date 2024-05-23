<?php

namespace App\Repositories\PeriodicExpnses;

use App\Models\PeriodicExpnses;
use App\Repositories\PeriodicExpnses\PeriodicExpnsesRepository;

class EloquentPeriodicExpnses implements PeriodicExpnsesRepository
{
    /**
     * {@inheritdoc}
     */
    public function all()
    {
        return PeriodicExpnses::all();
    }

    /**
     * {@inheritdoc}
     */
    public function count(){
        return PeriodicExpnses::count();
    }

    /**
     * {@inheritdoc}
     */
    public function byExpensesId($id){
        return PeriodicExpnses::whereExpensesId($id)->get();
    }

    /**
     * {@inheritdoc}
     */
    public function find($id)
    {
        return PeriodicExpnses::find($id);
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function create(array $data)
    {
        $TypesOfExpenses = PeriodicExpnses::create($data);

        return $TypesOfExpenses;
    }

    /**
     * {@inheritdoc}
     */
    public function update($id, array $data)
    {
        $PeriodicExpnses = $this->find($id);

        $PeriodicExpnses->update($data);

        return $PeriodicExpnses;
    }

    /**
     * {@inheritdoc}
     */
    public function delete($id)
    {
        $PeriodicExpnses = $this->find($id);

        return $PeriodicExpnses->delete();
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
        $query = PeriodicExpnses::query();

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
