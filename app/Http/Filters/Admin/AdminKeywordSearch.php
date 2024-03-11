<?php

namespace App\Http\Filters\Admin;

use Spatie\QueryBuilder\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;

class AdminKeywordSearch implements Filter
{
    public function __invoke(Builder $query, $search, string $property = '')
    {
        $query->where(function ($q) use ($search) {
            $q->where('name', "like", "%{$search}%");
            $q->orWhere('email', 'like', "%{$search}%");
        });
    }
}