<?php

namespace Database\Factories;

use App\Models\Notification;
use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Notification>
 */
class NotificationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'student_id' => Student::factory() ,
            'title' => $this->faker->sentence,
            'message' => $this->faker->paragraph,
        ];
    }
}
