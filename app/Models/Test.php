<?php

namespace App\Models;

use App\Models\Student;
use App\Models\Subject;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Test extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'student_id',
        'subject_id',
        'rate',
        // 'notes'
    ];

    public function getResultAttribute()
    {
        return $this->rate * $this->subject->coef;
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }
}
