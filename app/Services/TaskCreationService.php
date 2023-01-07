<?php
namespace App\Services;

use App\Jobs\UpdateUserStatistics;
use App\Models\Task;
use App\Repository\Eloquent\Task\TaskRepository;

class TaskCreationService 
{
    private TaskRepository $taskRepository;

    public function __construct(TaskRepository $taskRepository)
    {
        $this->taskRepository = $taskRepository;
    }

    /**
     *
     * @param array $attributes
     * @return void
     */
    public function create(array $attributes) : Task
    {
        $task = $this->taskRepository->create($attributes);
        $this->dispatchUpdateUserStatisticsJob($attributes['assigned_to_id']);
        
        return $task;
    }

    private function dispatchUpdateUserStatisticsJob(int $userId) : void
    {
        UpdateUserStatistics::dispatch($userId);
    }
}