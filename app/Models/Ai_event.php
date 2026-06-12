<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ai_event extends Model
{
    protected $fillable = [
        'description','event_type',''
    ];

    public function student()
{
    return $this->belongsTo(Student::class);
}
}
