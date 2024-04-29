<?php

namespace App\Http\Filters\Student;

use Illuminate\Database\Eloquent\Builder;
use Spatie\QueryBuilder\Filters\Filter;

class StudentKeywordBetweenDate implements Filter
{
    public function __invoke(Builder $query, $start_date, $end_date, string $property = '')
    {
        $query->where(function ($q) use ($start_date, $end_date) {
            $q->orWhereBetween('start_date', [$start_date, $end_date]);
            $q->orWhereBetween('end_date', [$start_date, $end_date]);
            // $q->get();
            // // $q->whereBetween('start_date', [$start_date,$end_date]);
            // // $q->whereBetween('end_date', [$start_date,$end_date]);
        });
    }
}
