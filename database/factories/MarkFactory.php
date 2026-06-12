<?php

namespace Database\Factories;

use App\Models\Mark;
use App\Models\Student;
use App\Models\Subject;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Mark>
 */
class MarkFactory extends Factory
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
        'subject_id' => Subject::factory(),
        'score' => $this->faker->numberBetween(50, 100),
        'chapter' => fake()->randomElement(['first_chapter', 'second_chapter', ]),
        'academic_year' => '2023-2024',
        ];
    }
}
