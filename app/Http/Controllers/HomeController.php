<?php

namespace App\Http\Controllers;

use App\Http\Resources\StudentResource;
use App\Traits\HttpResponces;
use Illuminate\Cache\Events\RetrievingKey;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    use HttpResponces;
    public function index($student_id){
        $parent = auth()->user();

        $student = $parent->students()->where('student_id',$student_id)->first();

        if(!$student){
            return $this->error('','Student does not exsist',404);
        }

        return $this->success([
            'student' => new StudentResource($student),
        ]);

    }
}
