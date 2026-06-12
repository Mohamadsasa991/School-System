<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentPermission extends Model
{
    /** @use HasFactory<\Database\Factories\StudentPermissionFactory> */
    use HasFactory;

    protected $fillable = [
        'student_id',
        'title',
        'description',
        'date',
        'status',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

}
