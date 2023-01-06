<?php

namespace Database\Factories;

use App\Constants\UserType;
use App\Models\User;
use Illuminate\Contracts\Auth\Factory as AuthFactory;
use Illuminate\Database\Eloquent\Factories\Factory;

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
    public function definition()
    {
        return [
            'title' => fake()->name(),
            'description' => fake()->unique()->safeEmail(),
            'assigned_to_id' => function(){
                return User::factory()->create(['type' => UserType::NORMAL])->id;
            },
            'assigned_by_id' => function(){
                return User::factory()->create(['type' => UserType::ADMIN])->id;
            }
        ];
    }
}
