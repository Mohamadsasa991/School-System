<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Behavior_record extends Model
{
    protected $fillable = [
        'date','behavior_type','notes'
    ];

    public function student(){
        return $this->belongsTo(Student::class);
    }
}
