<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use App\Constants\UserType;
use Illuminate\Http\Request;
use App\Jobs\UpdateUserStatistics;
use App\Http\Requests\Task\StoreTaskRequest;

class TaskController extends Controller
{
    const TASKS_PER_PAGE = 10;
    const DAY_IN_SECONDS = 86400;
        
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index()
    {
        $tasks = Task::query()
            ->with(['assignedTo:id,name', 'assignedBy:id,name'])
            ->paginate(self::TASKS_PER_PAGE);

        return view('tasks.index', [
            'tasks' => $tasks
        ]);
    }

    public function create()
    {
        $admins = User::ofType(UserType::ADMIN)
            ->toBase()
            ->get(['id', 'name']);

        $users  = cache()->remember('users', self::DAY_IN_SECONDS, function () {
            return User::ofType(UserType::NORMAL)->toBase()->get(['id', 'name']);
        });

        return view('tasks.create', get_defined_vars());
    }

    public function store(StoreTaskRequest $request)
    {
        Task::create($request->validated());

        UpdateUserStatistics::dispatch($request->assigned_to_id);

        return to_route('tasks.index');
    }
}