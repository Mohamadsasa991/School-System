<?php

namespace Database\Seeders;

use App\Models\Student;
use App\Models\StudentPermission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StudentPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $students = Student::all();

        foreach($students as $student){
          StudentPermission::factory()->count(5)->create([
            'student_id' => $student->id
          ]);
        }
    }
}
