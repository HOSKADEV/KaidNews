<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TvReport extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'evaluation_id',
        'attractiveness_initiation',
        'respect_duration',
        'language_integrity',
        'interviews',
        'vocal_performance',
        'use_scenes',
        'spontaneous_scene',
        'content',
        'conclusion',
        'overall_assessment',
    ];
}
