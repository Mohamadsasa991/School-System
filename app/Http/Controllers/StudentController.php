<?php

namespace App\Http\Controllers;

use App\Http\Resources\NotificationResource;
use App\Http\Resources\ProfileResource;
use App\Http\Resources\StudentResource;
use App\Mail\SendStudentCode;
use App\Models\Student;
use App\Traits\HttpResponces;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class StudentController extends Controller
{
    use HttpResponces;
   public function linkStudent(Request $request)
{
    $request->validate([
        'student_code' => 'required|string',
    ]);

    $parent = Auth::user();

    $student = Student::where(
        'code',
        $request->student_code
    )->first();

    if (!$student) {
        return $this->error(
            '',
            'Invalid student code',
            404
        );
    }

    if ($student->parent_email !== $parent->email) {
        return $this->error(
            '',
            'This student code does not belong to you',
            403
        );
    }

    if (
        $parent->students()
            ->where('student_id', $student->id)
            ->exists()
    ) {
        return $this->success([
            'message' => 'Student already linked',
            'student' => new StudentResource($student),
        ]);
    }

    $parent->students()->attach($student->id);

    return $this->success([
        'message' => 'Student linked successfully',
        'student' => new StudentResource($student),
    ]);
}


    public function sendCodes() {
        $parent = auth()->user();
        $students = Student::where('parent_email',$parent->email)->get();

        if($students->isEmpty()){
            return $this->error('','No students found', 404);
        }
        foreach($students as $student){
             if ($parent->students()->where('student_id', $student->id)->exists()) {
            Mail::to($parent->email)->send(new SendStudentCode($students));
        }
        }

        return $this->success([
            'message' => 'Codes Sent Successfully'
        ]);
    }

    public function getStudentProfile($student_id){
            $parent = auth()->user();

        $student = $parent->students()->where('student_id',$student_id)->first();

        if(!$student){
            return $this->error('','Student does not exsist',404);
        }

            return $this->success([
                'student' => new ProfileResource($student->load('schoolClass'))
            ]);
    }

    public function getNotifications($student_id){
    $parent = auth()->user();
    $student = $parent->students()->where('student_id',$student_id)->first();
        if(!$student){
            return $this->error('','Student does not exsist',404);
        }

    $notifications = $student->notifications()->latest()->get();

        return $this->success([
            'notifications' => NotificationResource::collection($notifications)
        ]);
    }
}
