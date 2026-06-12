<?php

namespace Database\Factories;

use App\Models\Attendance;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Attendance>
 */
class AttendanceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
        'student_id' => \App\Models\Student::factory(),
        'date' => $this->faker->date(),
        'status' => $this->faker->randomElement([
            'present', 'absent', 'late'
        ]),
        'notes' => $this->faker->sentence(),
        'academic_year' => $this->faker->year(),
        ];
    }
}
