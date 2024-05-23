<?php

namespace App\Repositories\TypesExpenses;

use App\Models\TypesOfExpenses;
use App\Repositories\TypesExpenses\TypesExpensesRepository;

class EloquentTypesExpenses implements TypesExpensesRepository
{
    /**
     * {@inheritdoc}
     */
    public function all()
    {
        return TypesOfExpenses::all();
    }

    /**
     * {@inheritdoc}
     */
    public function count(){
        return TypesOfExpenses::count();
    }

    /**
     * {@inheritdoc}
     */
    public function byExpensesId($id){
        return TypesOfExpenses::whereExpensesId($id)->get();
    }

    /**
     * {@inheritdoc}
     */
    public function find($id)
    {
        return TypesOfExpenses::find($id);
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function create(array $data)
    {
        $TypesOfExpenses = TypesOfExpenses::create($data);

        return $TypesOfExpenses;
    }

    /**
     * {@inheritdoc}
     */
    public function update($id, array $data)
    {
        $TypesOfExpenses = $this->find($id);

        $TypesOfExpenses->update($data);

        return $TypesOfExpenses;
    }

    /**
     * {@inheritdoc}
     */
    public function delete($id)
    {
        $TypesOfExpenses = $this->find($id);

        return $TypesOfExpenses->delete();
    }

    /**
     * @param $perPage
     * @param null $status
     * @param null $searchFrom
     * @param $searchTo
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator|mixed
     */
    public function paginate($perPage, $search = null)
    {
        $query = TypesOfExpenses::query();

        $result = $query->orderBy('id', 'desc')
            ->paginate($perPage);

        if ($search) {
            $result->appends(['search' => $search]);
        }
        return $result;
    }
}
