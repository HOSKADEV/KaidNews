<?php

namespace App\Models;

use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Teacher extends Authenticatable
{
    use HasFactory , SoftDeletes;

    protected $fillable = [
        'firstname_ar',
        'firstname_fr',
        'lastname_ar',
        'lastname_fr',
        'gender',
        'birthday',
        'phone',
        'address',
        'photo',
        'status'
    ];

    public function setPasswordAttribute($value): void
    {
        $this->attributes['password'] = Hash::make($value);
    }

    public function getNameAttribute()
    {
        return ucwords("{$this->firstname_ar} {$this->lastname_ar}");
    }
}
