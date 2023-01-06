<?php
namespace App\Services;

use App\Models\User;
use App\Constants\UserType;
use Illuminate\Contracts\Cache\Repository;


class CachedUsersService
{
    const DAY_IN_SECONDS = 86400;

    private Repository $cacheRepository;

    public function __construct(Repository $cacheRepository)
    {
        $this->cacheRepository = $cacheRepository;
    }

    public function getUsers()
    {
        return $this->cacheRepository->remember('users', self::DAY_IN_SECONDS, function () {
            return User::ofType(UserType::NORMAL)->toBase()->get(['id', 'name']);
        });
    }
}