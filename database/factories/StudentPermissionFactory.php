<?php

namespace Database\Factories;

use App\Models\Student;
use App\Models\StudentPermission;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<StudentPermission>
 */
class StudentPermissionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'student_id' => Student::factory(),
            'title' => $this->faker->title(),
            'description' => $this->faker->paragraph,
            'date' => $this->faker->date(),
            'status' => $this->faker->randomElement(['pending', 'approved', 'rejected']),
        ];
    }
}
