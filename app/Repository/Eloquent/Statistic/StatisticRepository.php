<?php
namespace App\Repository\Eloquent\Statistic;

use App\Models\Statistic;
use Illuminate\Database\Eloquent\Model;
use App\Repository\Eloquent\BaseRepository;
use Illuminate\Contracts\Database\Eloquent\Builder;

class StatisticRepository extends BaseRepository
{
    protected Model|Builder $model;

    public function __construct(Statistic $model)
    {
        $this->model = $model;
    }

    public function getTopStatistics(int $limit = 10)
    {
        return $this->model->latest('task_count')->limit($limit)->get();
    }
}