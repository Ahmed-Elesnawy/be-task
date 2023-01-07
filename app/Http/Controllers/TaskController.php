<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use App\Constants\UserType;
use Illuminate\Http\Request;
use App\Jobs\UpdateUserStatistics;
use App\Http\Requests\Task\StoreTaskRequest;
use App\Repository\Eloquent\Task\TaskRepository;
use App\Repository\Eloquent\User\UserRepository;
use App\Services\TaskCreationService;

class TaskController extends Controller
{
    const TASKS_PER_PAGE = 10;

    private UserRepository $userRepository;

    private TaskRepository $taskRepository;

    private TaskCreationService $taskCreationService;

    public function __construct(UserRepository $userRepository, TaskRepository $taskRepository,TaskCreationService $taskCreationService)
    {
        $this->userRepository = $userRepository;
        $this->taskRepository = $taskRepository;
        $this->taskCreationService = $taskCreationService;
    }

    public function index()
    {
        $tasks = $this->taskRepository
            ->eagerLoad(['assignedTo:id,name', 'assignedBy:id,name'])
            ->findAllPaginated(self::TASKS_PER_PAGE);

        return view('tasks.index', [
            'tasks' => $tasks
        ]);
    }

    public function create()
    {
        $admins = $this->userRepository->getAllAdmins(['id', 'name']);

        $users  = $this->userRepository->getCachedUsers(['id', 'name']);

        return view('tasks.create', get_defined_vars());
    }

    public function store(StoreTaskRequest $request)
    {
        $this->taskCreationService->create($request->validated());

        return to_route('tasks.index');
    }
}
