<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::all()->random()->id,
            'task_name' => $this->faker->unique()->sentence(),
            'task_description' => $this->faker->text(),
            'task_priority' => rand(1, 4),
            'task_status' => rand(1, 4),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
