<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DirectionCamera extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'evaluation_id',
        'content',
        'vocal_performance',
        'attendance',
        'participation_effectiveness',
        'overall_assessment',
    ];
}
