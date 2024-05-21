<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TypesOfExpenses extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
      'expenses_id',
      'name',
    ];

    public function situational()
    {
      return $this->hasMany(SituationalExpnses::class);
    }

    public function employee()
    {
      return $this->hasMany(EmployeeExpnses::class);
    }

    public function periodic()
    {
      return $this->hasMany(PeriodicExpnses::class);
    }
}
