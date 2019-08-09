<?php

namespace App\Repositories\UserRepository;

use App\Models\User;
use App\Repositories\EloquentRepository;

/**
 * Class UserEloquentRepository
 * @package App\Repositories\UserRepository
 */
class UserEloquentRepository extends EloquentRepository implements UserRepositoryInterface
{
    /**
     * Get model.
     *
     * @return string
     */
    public function getModel()
    {
        return User::class;
    }
}
