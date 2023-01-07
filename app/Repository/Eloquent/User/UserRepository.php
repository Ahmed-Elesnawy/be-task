<?php
namespace App\Repository\Eloquent\User;

use App\Constants\UserType;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use App\Repository\Eloquent\BaseRepository;
use Illuminate\Contracts\Database\Eloquent\Builder;

class UserRepository extends BaseRepository
{
    const DAY_IN_SECONDS = 86400;

    protected Model|Builder $model;

    public function __construct(User $model)
    {
        $this->model = $model;
    }

    public function getAllAdmins(array $selects = ['*'])
    {
        return $this->model->ofType(UserType::ADMIN)->toBase()->get($selects);
    }

    public function getCachedUsers(array $selects = ['*'])
    {
        return cache()->remember('users', self::DAY_IN_SECONDS, function () use($selects) {
            return User::ofType(UserType::NORMAL)->toBase()->get($selects);
        });
    }

}