<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Task;
use App\Models\User;
use App\Constants\UserType;
use Illuminate\Http\Response;
use App\Jobs\UpdateUserStatistics;
use Illuminate\Support\Facades\Queue;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class TaskTest extends TestCase
{
    use RefreshDatabase;
    use WithoutMiddleware;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_tasks_list_page_is_working_successfully()
    {
        // Given
        $admin = User::factory()->create(['type' => UserType::ADMIN]);
        $this->actingAs($admin);

        // When
        $response = $this->get('tasks');

        // Then
        $response->assertSee('Tasks');
        $response->assertStatus(Response::HTTP_OK);
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_no_tasks_available_is_showed_if_no_tasks_available()
    {
        // Given
        $admin = User::factory()->create(['type' => UserType::ADMIN]);
        $this->actingAs($admin);

        // When
        $response = $this->get('tasks');

        // Then
        $response->assertSee('No Tasks Available');
        $response->assertStatus(Response::HTTP_OK);
    }
    
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_admin_cannot_able_to_create_task_with_empty_data()
    {
        // Given
        $taskData = [];

        $admin = User::factory()->create(['type' => UserType::ADMIN]);
        $this->actingAs($admin);

        // When
        $response = $this->post('tasks',$taskData);

        // Then
        $response->assertSessionHasErrors();
        $response->assertStatus(Response::HTTP_FOUND);

    }

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

     /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_normal_user_cannot_create_task()
    {
        // Given
        $taskData = Task::factory()->make()->toArray();
        $user = User::factory()->create(['type' => UserType::NORMAL]);
        $this->actingAs($user);


        // When
        $response = $this->post('tasks',$taskData);

        // Then
        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }

     /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_update_users_statistics_pushed_to_jobs_when_create_task()
    {
        // Given
        $taskData = Task::factory()->make()->toArray();
        $admin = User::factory()->create(['type' => UserType::ADMIN]);
        $this->actingAs($admin);
        Queue::fake();
        
        // When
        $response = $this->post('tasks',$taskData);

        // Then
        Queue::assertPushed(UpdateUserStatistics::class);
    }

}
