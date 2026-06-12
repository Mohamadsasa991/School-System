<?php

namespace App\Http\Controllers;

use App\Http\Resources\AttendanceResource;
use App\Traits\HttpResponces;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    use HttpResponces;
    public function index($student_id){
        $parent = auth()->user();

        $student = $parent->students()->where('student_id',$student_id)->first();

        if(!$student){
            return $this->error('','Student does not exsist',404);
        }

        return $this->success([
            'summary' => $student->attendanceSummary(),
            'attendance' => AttendanceResource::collection(
                $student->attendances()
                ->orderBy('date','desc')->get()
            )
        ]);
    }
}
