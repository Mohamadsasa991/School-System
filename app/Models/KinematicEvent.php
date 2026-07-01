<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KinematicEvent extends Model
{
    protected $fillable = [
        'student_id',
        'event_type',
        'amplitude',
        'frequency',
        'confidence',
        'timestamp',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
