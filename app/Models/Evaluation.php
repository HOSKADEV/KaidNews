<?php

namespace App\Models;

use App\Models\Admin;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Evaluation extends Model
{
    use HasFactory , SoftDeletes;

    protected $fillable = [
        'student_id',
        'created_by',
        'rank',
        'golden_passport',
    ];

    public function evaluatedBy()
    {
        return $this->belongsTo(Admin::class,'created_by');
    }
}
