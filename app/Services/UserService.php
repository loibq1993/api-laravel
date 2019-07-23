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

    
}
