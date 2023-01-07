<?php
namespace App\Repository\Eloquent\Task;

use App\Models\Task;
use Illuminate\Database\Eloquent\Model;
use App\Repository\Eloquent\BaseRepository;
use Illuminate\Contracts\Database\Eloquent\Builder;

class TaskRepository extends BaseRepository
{
    protected Model|Builder $model;

    public function __construct(Task $model)
    {
        $this->model = $model;
    }
}