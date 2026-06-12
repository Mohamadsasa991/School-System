<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePermissionRequest;
use App\Http\Resources\StudentPermissionResource;
use App\Traits\HttpResponces;
use Illuminate\Http\Request;

class StudentPermissionController extends Controller
{
     use HttpResponces;
    /**
     * Display a listing of the resource.
     */
    public function index($student_id ,Request $request)
    {
          $parent = auth()->user();
        $student = $parent->students()->where('student_id',$student_id)->first();

         if(!$student){
            return $this->error('','Student does not exsist',404);
        }

        $permissions = $student->permissions()
        ->when($request->status && $request->status != 'all',
         fn($q) =>$q->where('status',$request->status)
         )
         ->latest()->get();

        return $this->success(StudentPermissionResource::collection($permissions),'Permissions retrieved successfully');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePermissionRequest $request,$student_id)
    {
        $data = $request->validated();

        $parent = auth()->user();
        $student = $parent->students()->where('student_id',$student_id)->first();
         if(!$student){
            return $this->error('','Student does not exsist',404);
        }
        $permission = $student->permissions()->create($data);
        return $this->success(new StudentPermissionResource($permission),'Permission created successfully',201);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
