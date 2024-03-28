<?php

namespace App\Models;

use App\Models\Test;
use App\Models\Attendence;
use App\Models\Certificate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Student extends Authenticatable
{
    use HasFactory , SoftDeletes;

    protected $fillable = [
        'firstname_ar',
        'firstname_fr',
        'lastname_ar',
        'lastname_fr',
        'gender',
        'birthday',
        'state_of_birth',
        'place_of_birth',

        'photo',
        'status',

        'group',
        'registration_number',
        'residence',
        'batch',
        'start_date',
        'end_date',

        'phone',
        'email',
        'password',
    ];

    public function setPasswordAttribute($value): void
    {
        $this->attributes['password'] = Hash::make($value);
    }

    public function getNameAttribute()
    {
        return ucwords("{$this->firstname_ar} {$this->lastname_ar}");
    }
    public function getTotalCoefAttribute(){
        $totalCoef = 0;
        foreach ($this->tests as $test) {
            $totalCoef = $totalCoef + $test->subject->coef;
        }
        return $totalCoef;
    }

    public function getNoteAttribute(){
        $totalNote= 0;
        foreach ($this->tests as $test) {
            $totalNote = $totalNote + $test->subject->coef * $test->rate;
        }
        return $totalNote;
    }

    // total_coef
    public function getMoyenAttribute()
    {
        $moyen  = 0;
        foreach ($this->tests as $test) {
            $moyen = $moyen + $test->result;
        }
        return  $this->total_coef > 0 ? $moyen / $this->total_coef : null;
    }
    public function tests()
    {
        return $this->hasMany(Test::class);
    }

    public function certificate()
    {
        return $this->hasMany(Certificate::class);
    }
    public function attendences(): HasMany
    {
        return $this->hasMany(Attendence::class);
    }
}


