<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentPhoto extends Model
{
    protected $fillable = [
        'student_id','photo_path'
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
