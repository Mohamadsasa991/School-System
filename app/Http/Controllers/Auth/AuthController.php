<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\RegisterUserRequest;
use App\Http\Resources\ParentResource;
use App\Mail\SendStudentCode;
use App\Models\Student;
use App\Models\User;
use App\Traits\HttpResponces;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    use HttpResponces;
    public function register(RegisterUserRequest $request){
        $parent = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password'=> Hash::make($request->password),
        ]);

        $students = Student::where('parent_email',$parent->email)->get();

                // Log::info('hello');

                Mail::to($parent->email)->send(new SendStudentCode($students));
                // Log::info($students);


        $token = $parent->createToken('api-token')->plainTextToken;

        return $this->success([
            'parent' => new ParentResource($parent->load('students')),
            'token' => $token
        ]);
    }

    public function login(LoginUserRequest $request){
        if(!Auth::attempt($request->only(['email','password']))){
            return $this->error('', 'Credentials do not match',401);
        }
        $parent =Auth::user();

        $token = $parent->createToken('api-token')->plainTextToken;

         $student = $parent->students()->where('parent_email',$parent->email)->first();

        if(!$student){
            return $this->error('','You are not linked to any student',404);
        }
        return $this->success([
            'parent' => new ParentResource($parent->load('students')),
            'token' => $token
        ]);
    }

    public function logout(){
        Auth::user()->currentAccessToken()->delete();
        return $this->success([
            'message' => 'You have succesfully been logged out and your token has been removed'
        ]);
    }
}
