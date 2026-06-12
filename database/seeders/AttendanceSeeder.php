<?php

namespace Database\Seeders;

use App\Models\Attendance;
use App\Models\Student;
use Illuminate\Database\Seeder;

class AttendanceSeeder extends Seeder
{
    public function run(): void
    {
        $students = Student::all();

        foreach ($students as $student) {

            Attendance::factory()
                ->count(7)
                ->create([
                    'student_id' => $student->id
                ]);
        }
    }
}
