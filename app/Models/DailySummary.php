<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DailySummary extends Model
{
    protected $fillable = [
        'student_id','summary_date',
        'avg_participating_count',
        'avg_not_paying_count',
        'avg_state_transitions',
        'avg_recovery_latency_s',
        'max_inattention_streak','total_aggression_events',
        'max_aggression_in_window',
        'total_wrist_oscillations',
        'total_body_sway_events','observation_window_minutes',
        'staff_report_json',
        'parent_report_json',
        'report_generated_at',
        'review_status'
    ];

protected $casts = [
    'parent_report_json' => 'array',
    'staff_report_json' => 'array',
    'summary_date' => 'date',
    'generated_at' => 'datetime',
    'report_generated_at' => 'datetime',
];


      public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
