<?php

namespace Database\Seeders;

use App\Models\Mark;
use App\Models\Student;
use App\Models\Subject;
use Illuminate\Database\Seeder;

class MarkSeeder extends Seeder
{
    public function run(): void
    {
        $students = Student::all();

        $subjects = Subject::all();

        $data = [];

        foreach ($students as $student) {

            foreach ($subjects as $subject) {

                $data[]=[
                    'student_id' => $student->id,
                    'subject_id' => $subject->id,
                    'score' => fake()->numberBetween(40, 100),
                    'chapter' => fake()->randomElement(['first_chapter','second_chapter']),
                    'academic_year' => '2023-2024'
                ];
            }
        }
        Mark::insert($data);
    }
}
