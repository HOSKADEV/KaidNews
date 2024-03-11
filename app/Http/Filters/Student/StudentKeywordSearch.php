<?php

namespace App\Http\Filters\Student;

use Spatie\QueryBuilder\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;

class StudentKeywordSearch implements Filter
{
    public function __invoke(Builder $query, $search, string $property = '')
    {
        $query->where(function ($q) use ($search) {
            $q->where('firstname_fr', "like", "%{$search}%");
            $q->orWhere('firstname_ar', "like", "%{$search}%");
            $q->orWhere('lastname_fr', "like", "%{$search}%");
            $q->orWhere('lastname_ar', "like", "%{$search}%");
            $q->orWhere('email', 'like', "%{$search}%");
        });
    }
}