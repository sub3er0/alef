<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    use HasFactory;
    public function student()
    {
        return $this->hasMany('App\Models\Student');
    }

    public function plan()
    {
        return $this->hasOne('App\Models\Plan');
    }

    public function lecture()
    {
        return $this->belongsToMany('App\Models\Lecture');
    }
}
