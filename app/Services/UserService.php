<?php

namespace App\Services;

use App\Repositories\UserReporitory\UserReporitoryInterface;

/**
 * Class UserService
 */
class UserService
{
    protected $repository;
    
    public function __construct(UserRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function create($data)
    {
        $this->repository->create($data);
    }

    public function findWhere($where, bool $getFirst = false)
    {
        $this->repository->create($data);
    }
}
