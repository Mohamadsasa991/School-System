<?php

namespace App\Http\Controllers;

use App\Http\Resources\MarkResource;
use App\Traits\HttpResponces;
use Illuminate\Http\Request;
use Log;

class MarksController extends Controller
{
    use HttpResponces;
    public function getMarks($student_id , Request $request){

        $student = auth()->user()
        ->students()
        ->where('student_id', $student_id)
        ->first();

         if(!$student){
            return $this->error('','Student does not exsist',404);
        }

        $marks = $student->marks()
        ->with('subject')
        ->when($request->chapter, fn($q) => $q->where('chapter', $request->chapter))
        ->get();

        return $this->success([
            'chapter' => $request->chapter,
            'subjects' => MarkResource::collection($marks),
            'Behavior' => "good"
        ]);

    }
}
