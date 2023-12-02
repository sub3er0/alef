<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory;

    protected $fillable = [
        'grade_id',
        'lecture_id',
        'priority'
    ];

    public function grade()
    {
        return $this->belongsTo('App\Models\Grade');
    }

    public function lectures()
    {
        return $this->belongsToMany(Lecture::class, 'plan_lectures', 'plan_id', 'lecture_id');
    }
}
