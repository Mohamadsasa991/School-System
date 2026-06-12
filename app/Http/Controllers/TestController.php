<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function behavior(Request $request)
    {
        DB::table('behavior_events')->insert([
            'student_id' => $request->student_id,
            'label' => $request->label,
            'timestamp' => $request->timestamp,
        ]);
    }

     public function aggression(Request $request)
    {
         DB::table('aggression_events')->insert([
            'student_id' => $request->student_id,
            'label' => $request->label,
            'timestamp' => $request->timestamp,
        ]);
    }

     public function kinematic(Request $request)
    {
        DB::table('kinematic_events')->insert([
            'student_id' => $request->student_id,
            'event_type' => $request->event_type,
            'amplitude' => $request->amplitude,
            'frequency' => $request->frequency,
            'confidence' => $request->confidence,
            'timestamp' => $request->timestamp,
        ]);
    }

  public function checkpoints(Request $request)
    {
        $validated = $request->validate([
            'student_id'                 => 'required|string|max:64',
            'session_date'               => 'required|date',
            'checkpoint_time'            => 'nullable|date',
            'participating_count'        => 'nullable|integer',
            'not_paying_count'           => 'nullable|integer',
            'max_inattention_streak'     => 'nullable|integer',
            'state_transitions'          => 'nullable|integer',
            'median_recovery_latency_s'  => 'nullable|numeric',
            'aggression_event_count'     => 'nullable|integer',
            'wrist_oscillation_count'    => 'nullable|integer',
            'body_sway_count'            => 'nullable|integer',
        ]);

        DB::table('session_checkpoints')->insert([
            'student_id'                 => $validated['student_id'],
            'session_date'               => $validated['session_date'],
            'checkpoint_time'            => $validated['checkpoint_time'] ?? now(),
            'participating_count'        => $validated['participating_count'] ?? 0,
            'not_paying_count'           => $validated['not_paying_count'] ?? 0,
            'max_inattention_streak'     => $validated['max_inattention_streak'] ?? 0,
            'state_transitions'          => $validated['state_transitions'] ?? 0,
            'median_recovery_latency_s'  => $validated['median_recovery_latency_s'] ?? null,
            'aggression_event_count'     => $validated['aggression_event_count'] ?? 0,
            'wrist_oscillation_count'    => $validated['wrist_oscillation_count'] ?? 0,
            'body_sway_count'            => $validated['body_sway_count'] ?? 0,
        ]);

        return response()->json(['status' => 'ok'], 201);
    }

      public function reports(Request $request)
    {
         DB::table('daily_summaries')->insert([
            'student_id' => $request->student_id,
            'summary_data' => $request->summary_data,
            'staff_report_text' => $request->staff_report_text,
            'parent_report_text' => $request->parent_report_text,
        ]);
    }


}
