<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use App\Constants\UserType;
use Illuminate\Http\Request;
use App\Http\Requests\Task\StoreTaskRequest;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::query()
            ->with(['assignedTo:id,name', 'assignedBy:id,name'])
            ->paginate(10);

        return view('tasks.index', [
            'tasks' => $tasks
        ]);
    }

    public function create()
    {
        $admins = User::ofType(UserType::ADMIN)->toBase()->get(['id','name']);
        $users  = User::ofType(UserType::NORMAL)->toBase()->get(['id','name']);

        return view('tasks.create',get_defined_vars());
    }

    public function store(StoreTaskRequest $request)
    {
        $task = Task::create($request->validated());
    }
}
