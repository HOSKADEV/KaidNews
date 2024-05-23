<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use PhpParser\Node\Expr\Cast\Double;

class EmployeeExpnses extends Model
{
    use HasFactory ,SoftDeletes;

    protected $fillable = [
      'types_of_expenses_id',
      'name',
      'amount',
      'month',
      'year',
      'notes'
    ];

    protected $casts = [
      'amount' => 'double'
    ];

    public function typeExpenses()
    {
      return $this->belongsTo(TypesOfExpenses::class, 'types_of_expenses_id');
    }
}
