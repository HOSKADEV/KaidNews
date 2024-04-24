<?php

namespace App\Repositories\Evaluation;

use App\Models\Test;

use App\Http\Filters\Student\StudentKeywordSearch;
use App\Repositories\Evaluation\EvaluationRepository;
use Faker\Provider\ar_EG\Text;

class EloquentEvaluation implements EvaluationRepository
{
    /**
     * {@inheritdoc}
     */
    public function all()
    {
        return Test::all();
    }

    /**
     * {@inheritdoc}
     */
    public function find($id)
    {
        return Test::find($id);
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function create(array $data)
    {
        $evaluation = Test::create($data);

        return $evaluation;
    }

    public function getByStudent($id){

      $evaluation = Test::whereStudentId($id)->get();

      return $evaluation;
    }
    /**
     * {@inheritdoc}
     */
    public function update($id, array $data)
    {
        $evaluation = $this->find($id);

        $evaluation->update($data);

        return $evaluation;
    }

    /**
     * {@inheritdoc}
     */
    public function delete($id)
    {
        $evaluation = $this->find($id);

        return $evaluation->delete();
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

        $query = Test::query()->with('evaluatedBy','student','subject');

        // if ($status) {
        //     $query->where('status', $status);
        // }

        if ($search) {
            (new StudentKeywordSearch)($query, $search);
        }

        $result = $query->orderBy('id', 'desc')
            ->paginate($perPage);

        if ($search) {
            $result->appends(['search' => $search]);
        }
        return $result;
    }
}
