<?php

namespace App\Models;

use App\Models\Student;
use App\Models\TvReport;
use App\Models\MorningProgram;
use App\Models\DirectionCamera;
use App\Models\MobileJournalism;
use App\Models\JournalisticGenres;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Evaluation extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'student_id',
        'homeworks_questions',
        'attendance',
        'total_marks'
    ];

}
