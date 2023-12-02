<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlanLecture extends Model
{
    use HasFactory;

    protected $fillable = [
        'plan_id',
        'lecture_id',
        'priority'
    ];

    public function grades()
    {
        return $this->belongsTo(Plan::class);
    }

    public function lectures()
    {
        return $this->belongsTo(Lecture::class);
    }
}
