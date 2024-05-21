<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PeriodicExpnses extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
      'types_of_expenses_id',
      'amount',
      'month',
    ];

    public function typeExpenses()
    {
      return $this->belongsTo(TypesOfExpenses::class, 'types_of_expenses_id');
    }
}
