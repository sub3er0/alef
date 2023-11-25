<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lecture extends Model
{
    use HasFactory;
    protected $fillable = [
        'topic',
        'description'
    ];

    public function grade()
    {
        return $this->belongsToMany(Grade::class, 'plans', 'lecture_id', 'grade_id');
    }
}
