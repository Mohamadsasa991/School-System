<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SessionCheckpoint extends Model
{
    protected $fillable = [
        'student_id','session_date','participating_count','not_paying_count','max_inattention_streak','state_transitions','aggression_event_count','wrist_oscillation_count','body_sway_count','checkpoint_time'
    ];
      public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
