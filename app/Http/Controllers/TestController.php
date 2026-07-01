<?php

namespace App\Http\Controllers;
use App\Http\Resources\StudentEnrollmentResource;
use App\Models\AggressionEvent;
use App\Models\BehaviorEvent;
use App\Models\DailySummary;
use App\Models\KinematicEvent;
use App\Models\SessionCheckpoint;
use App\Models\Student;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use function Illuminate\Support\now;

class TestController extends Controller
{
    public function behavior(Request $request)
    {
      $data = $request->validate([
            'student_id' => 'required|string|max:64|exists:students,id',
            'label' => 'required|string|max:255',
            'timestamp' => 'required|date',
        ]);

        $event = BehaviorEvent::create($data);

        return response()->json([
            'message' => 'Behavior event stored successfully',
            'data' => $event,
        ],201);
    }

     public function aggression(Request $request)
    {
          $data = $request->validate([
            'student_id' => 'required|string|max:64|exists:students,id',
            'label' => 'required|string|max:255',
            'timestamp' => 'required|date',
        ]);

        AggressionEvent::create($data);

        return response()->json([
            'message' => 'Aggression event stored successfully',
        ],201);
    }

     public function kinematic(Request $request)
    {
        $data = $request->validate([
            'student_id' => ['required','exists:students,id'],
            'event_type' => ['required','string'],
            'amplitude' => ['nullable','numeric'],
            'frequency' => ['nullable','numeric'],
            'confidence' => ['nullable','numeric'],
            'timestamp' => ['required','date'],
        ]);

        $event = KinematicEvent::create($data);

        return response()->json([
            'message' => 'Kinematic event stored successfully',
            'data' => $event,
        ], 201);
    }

  public function checkpoints(Request $request)
    {
          $validated = $request->validate([
            'student_id' => ['required','exists:students,id'],
            'session_date' => ['required','date'],
            'checkpoint_time' => ['required','date'],

            'participating_count' => ['nullable','integer'],
            'not_paying_count' => ['nullable','integer'],
            'max_inattention_streak' => ['nullable','integer'],
            'state_transitions' => ['nullable','integer'],
            'aggression_event_count' => ['nullable','integer'],
            'wrist_oscillation_count' => ['nullable','integer'],
            'body_sway_count' => ['nullable','integer'],
        ]);

        $checkpoint = SessionCheckpoint::create($validated);

        return response()->json([
            'message' => 'Checkpoint stored successfully',
            'data' => $checkpoint,
        ], 201);
    }

    public function index($student_id){
    $summaries = DailySummary::when($student_id, function ($query) use ($student_id) {
            $query->where('student_id', $student_id);
        })
        ->orderBy('summary_date', 'desc')
        ->get();

    return response()->json([
        'message' => 'Summaries fetched successfully',
        'data'    => $summaries,
    ]);
    }

      public function reports(Request $request)
    {

        $validated = $request->validate([
            'student_id' => ['required','exists:students,id'],
            'summary_date' => ['required','date'],

            'avg_participating_count' => ['nullable','numeric'],
            'avg_not_paying_count' => ['nullable','numeric'],
            'avg_state_transitions' => ['nullable','numeric'],
            'avg_recovery_latency_s' => ['nullable','numeric'],

            'max_inattention_streak' => ['nullable','integer'],

            'total_aggression_events' => ['nullable','integer'],
            'max_aggression_in_window' => ['nullable','integer'],

            'total_wrist_oscillations' => ['nullable','integer'],
            'total_body_sway_events' => ['nullable','integer'],

            'observation_window_minutes' => ['nullable','numeric'],

            'staff_report_text' => ['nullable','string'],
            'parent_report_text' => ['nullable','string'],

            'report_generated_at' => ['nullable','date'],
            'generated_at' => ['nullable','date'],

            'review_status' => ['nullable','string'],
        ]);

        $summary = DailySummary::updateOrCreate(
            [
                'student_id' => $validated['student_id'],
                'summary_date' => $validated['summary_date'],
            ],
            $validated
        );

        return response()->json([
            'message' => 'Daily summary stored successfully',
            'data' => $summary,
        ], 201);
    }


    public function storeReport(Request $request)
{
    $validated = $request->validate([
        'summary_id'         => 'required|integer|exists:daily_summaries,id',
        'staff_report_text'  => 'required|string',
        'parent_report_text' => 'required|string',
    ]);

    $summary = DailySummary::findOrFail($validated['summary_id']);
    $summary->update([
        'staff_report_text'   => $validated['staff_report_text'],
        'parent_report_text'  => $validated['parent_report_text'],
        'report_generated_at' => now(),
    ]);

    return response()->json([
        'message' => 'Report saved successfully',
        'data'    => $summary,
    ]);
}

    public function today(Request $request){
        $request->validate([
        'date' =>'required|date'
        ]);

        $checkpoints = SessionCheckpoint::where('session_date',$request->date)
        ->get();

         return response()->json([
        'data' => $checkpoints
    ]);
    }

    public function store(Request $request){
         $validated = $request->validate([
        'student_id' => 'required|exists:students,id',
        'summary_date' => 'required|date',

        'avg_participating_count' => 'nullable|numeric',
        'avg_not_paying_count' => 'nullable|numeric',
        'avg_state_transitions' => 'nullable|numeric',
        'avg_recovery_latency_s' => 'nullable|numeric',

        'max_inattention_streak' => 'nullable|integer',

        'total_aggression_events' => 'nullable|integer',
        'max_aggression_in_window' => 'nullable|integer',

        'total_wrist_oscillations' => 'nullable|integer',
        'total_body_sway_events' => 'nullable|integer',

        'observation_window_minutes' => 'nullable|numeric',
    ]);

    $summary = DailySummary::updateOrCreate(
        [
            'student_id' => $validated['student_id'],
            'summary_date' => $validated['summary_date'],
        ],
        $validated
    );

    return response()->json([
        'message' => 'Summary saved',
        'data' => $summary
    ]);
    }

    public function purge(Request $request)
{
    $request->validate([
        'date' => 'required|date'
    ]);

    SessionCheckpoint::where(
        'session_date',
        $request->date
    )->delete();
    AggressionEvent::where(
        'session_date',
        $request->date
    )->delete();
    BehaviorEvent::where(
        'session_date',
        $request->date
    )->delete();


}

public function unreported(Request $request)
{
    $request->validate([
        'date' => 'required|date'
    ]);

    $summaries = DailySummary::where(
        'summary_date',
        $request->date
    )
    ->whereNull('staff_report_text')
    ->get();

    return response()->json([
        'data' => $summaries
    ]);
}

public function getPhotos(Request $request){
    return StudentEnrollmentResource::collection(
        Student::with('photos')->get()
    );
}


}
