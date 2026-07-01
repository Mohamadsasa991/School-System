<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AggressionEvent extends Model
{
    protected $fillable = [
        'student_id',
        'label',
        'timestamp',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
