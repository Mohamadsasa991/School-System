<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Psy\Completion\FuzzyMatcher;
use Str;

class Student extends Model
{
    use HasFactory;
     protected $fillable = [
        'full_name',
        'parent_email',
        'code',
        'class_id',
        'phone',
        'address'

     ];

     public function parents(){
        return $this->belongsToMany(User::class,'parent_student',
        'student_id','parent_id',);
     }

     public function attendances(){
        return $this->hasMany(Attendance::class);
     }

     public function behaviorRecords(){
        return $this->hasMany(Behavior_record::class);
     }

     public function aiEvents()
{
    return $this->hasMany(Ai_event::class);
}

    public function marks(){
        return $this->hasMany(Mark::class);
    }

    public function permissions(){
        return $this->hasMany(StudentPermission::class);
    }

    public function Notifications(){
        return $this->hasMany(Notification::class);
    }

    public function schoolClass(){
        return $this->belongsTo(SchoolClass::class, 'class_id');
    }


     public function attendanceSummary(){
    $attendance = $this->attendances();
        $present = (clone $attendance)->where('status','present')->count();
        $absent = (clone $attendance)->where('status','absent')->count();
        $late = (clone $attendance)->where('status','late')->count();

        $total = $present+$absent+$late;

        $percentage  = $total > 0 ? round((($present+$late)/$total)*100) : 0;

        return [
        'attendance_percentage' => $percentage,
        'present_days' => $present,
        'absent_days' => $absent,
        'late_days' => $late,
        ];
    }

    protected static function booted()
{
    static::creating(function ($student) {

        do {

            $code = 'STD-' . strtoupper(Str::random(6));

        } while (self::where('code', $code)->exists());

        $student->code = $code;
    });
}
}
