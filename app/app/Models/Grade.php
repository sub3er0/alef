<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function students()
    {
        return $this->hasMany('App\Models\Student');
    }

    public function plan()
    {
        return $this->hasOne('App\Models\Plan');
    }

    public function lecture()
    {
        return $this->belongsToMany(Lecture::class, 'plans', 'grade_id', 'lecture_id');
    }
}
