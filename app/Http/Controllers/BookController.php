<?php

namespace App\Http\Controllers;

use App\Http\Resources\BookResource;
use App\Models\Book;
use App\Traits\HttpResponces;
use Illuminate\Http\Request;

class BookController extends Controller
{
    use HttpResponces;
    public function index($student_id){
        $parent = auth()->user();

        $student = $parent->students()->where('student_id', $student_id)->first();

        if(!$student){
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $books = Book::with('subject')
        ->where('class_id', $student->class_id)
        ->get();

        return $this->success([
            'books' => BookResource::collection($books)
        ]);

    }
}
