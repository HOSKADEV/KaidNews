<?php

namespace App\Http\Filters\Student;

use Illuminate\Database\Eloquent\Builder;
use Spatie\QueryBuilder\Filters\Filter;

class FiltersByRank implements Filter
{
    public function __invoke(Builder $query, $rank ,string $property = '')
    {

        $query->whereHas('evaluations', function (Builder $query) use ($rank) {
            // $query->where('rank', $rank ? '*':'':);
            
            if($rank == 'all'){
               $query->where('rank',1);
               $query->orWhere('rank',2);
               $query->orWhere('rank',3);
            }
            $query->where('rank',$rank);
        });
    }
}
