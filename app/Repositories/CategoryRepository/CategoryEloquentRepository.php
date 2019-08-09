<?php

namespace App\Repositories\CategoryRepository;

use App\Models\Category;
use App\Repositories\EloquentRepository;

/**
 * Class CategoryEloquentRepository
 * @package App\Repositories\CategoryRepository
 */
class CategoryEloquentRepository extends EloquentRepository implements CategoryRepositoryInterface
{
    /**
     * Get model.
     *
     * @return string
     */
    public function getModel()
    {
        return Category::class;
    }
}
