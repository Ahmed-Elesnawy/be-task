<?php
namespace App\Repository\Eloquent;

use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Database\Eloquent\Builder;
use App\Repository\Contacts\BaseRepositoryInterface;

class BaseRepository implements BaseRepositoryInterface
{
    protected Model|Builder $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }
    
    public function findAll(array $columns = ["*"]) : Collection
    {
        return $this->model->all($columns) ;
    }

    public function findAllPaginated(int $perPage = 10,array $columns = ["*"]) : object
    {
        return $this->model->paginate($perPage,$columns);
    }

    public function find(int $id) : object
    {
        return $this->model->find($id);
    }

    public function findOne(array $attributes) : object
    {
        return $this->model->where($attributes)->first();
    }

    public function findWhere(array $attributes) : Collection
    {
        return $this->model->where($attributes)->get();
    }

    public function deleteWhere(array $attributes) : bool
    {
        return $this->model->where($attributes)->delete();
    }

    public function deleteById(int $id) : bool
    {
        return $this->model->find($id)->delete();
    }

    public function create(array $attributes) : object
    {
        return $this->model->create($attributes);
    }

    public function eagerLoad(array $relations)
    {
        $this->model = $this->model->with($relations);

        return $this;
    }
}