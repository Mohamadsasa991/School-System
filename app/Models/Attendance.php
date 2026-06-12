<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
     use HasFactory;
    protected $fillable = ['status','notes','date','academic_year',''];

    public function student(){
        return $this->belongsTo(Student::class);
    }


}
