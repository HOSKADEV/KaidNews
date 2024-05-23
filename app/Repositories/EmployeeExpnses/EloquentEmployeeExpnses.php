<?php

namespace App\Repositories\EmployeeExpnses;

use App\Models\EmployeeExpnses;
use App\Models\TypesOfExpenses;
use App\Repositories\EmployeeExpnses\EmployeeExpnsesRepository;

class EloquentEmployeeExpnses implements EmployeeExpnsesRepository
{
    /**
     * {@inheritdoc}
     */
    public function all()
    {
        return EmployeeExpnses::all();
    }

    /**
     * {@inheritdoc}
     */
    public function count(){
        return EmployeeExpnses::count();
    }

    /**
     * {@inheritdoc}
     */
    public function find($id)
    {
        return EmployeeExpnses::find($id);
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function create(array $data)
    {
        $EmployeeExpnses = EmployeeExpnses::create($data);

        return $EmployeeExpnses;
    }

    /**
     * {@inheritdoc}
     */
    public function update($id, array $data)
    {
        $EmployeeExpnses = $this->find($id);

        $EmployeeExpnses->update($data);

        return $EmployeeExpnses;
    }

    /**
     * {@inheritdoc}
     */
    public function delete($id)
    {
        $EmployeeExpnses = $this->find($id);

        return $EmployeeExpnses->delete();
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
        $query = EmployeeExpnses::query();

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
