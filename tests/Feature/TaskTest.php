<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Task;
use App\Models\User;
use App\Constants\UserType;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Http\Response;

class TaskTest extends TestCase
{
    use RefreshDatabase;
    use WithoutMiddleware;
    
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_admin_can_create_task()
    {
        // Given
        $taskData = Task::factory()->make()->toArray();
        $admin = User::factory()->create(['type' => UserType::ADMIN]);
        $this->actingAs($admin);
        $expectedDatabaseCount = 1;

        // When
        $response = $this->post('tasks',$taskData);

        // Then
        $this->assertDatabaseCount('tasks',$expectedDatabaseCount);
        $response->assertStatus(Response::HTTP_FOUND);
    }
}
