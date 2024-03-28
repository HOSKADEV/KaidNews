<?php

namespace App\Models;

use App\Models\Student;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Attendence extends Model
{

    use HasFactory , SoftDeletes;

    protected $fillable = [
        'student_id',
        'day',
        'week',
        'month',
        'year',
        'number'
    ];
    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }
}
