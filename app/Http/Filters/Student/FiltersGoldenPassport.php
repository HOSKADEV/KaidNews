<?php

namespace App\Http\Filters\Student;

use Illuminate\Database\Eloquent\Builder;
use Spatie\QueryBuilder\Filters\Filter;

class FiltersGoldenPassport implements Filter
{
    public function __invoke(Builder $query, $passport ,string $property = '')
    {

        $query->whereHas('evaluations', function (Builder $query) use ($passport) {
            $query->where('golden_passport', 1);
        });
    }
}
