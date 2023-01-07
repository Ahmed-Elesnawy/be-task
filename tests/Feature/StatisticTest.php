<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Constants\UserType;
use Illuminate\Foundation\Testing\WithFaker;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class StatisticTest extends TestCase
{
    use RefreshDatabase;
    use WithoutMiddleware;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_statistics_list_page_is_working_successfully()
    {
        // Given
        $admin = User::factory()->create(['type' => UserType::ADMIN]);
        $this->actingAs($admin);

        // When
        $response = $this->get('statistics');

        // Then
        $response->assertSee('Statistics');
        $response->assertStatus(Response::HTTP_OK);
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_no_statistics_available_is_showed_if_no_tasks_available()
    {
        // Given
        $admin = User::factory()->create(['type' => UserType::ADMIN]);
        $this->actingAs($admin);

        // When
        $response = $this->get('statistics');

        // Then
        $response->assertSee('No Statistics Available');
        $response->assertStatus(Response::HTTP_OK);
    }
}
