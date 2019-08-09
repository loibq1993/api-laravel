<?php

namespace App\Repositories\ProductRepository;

use App\Models\Product;
use App\Repositories\EloquentRepository;

/**
 * Class ProductEloquentRepository
 * @package App\Repositories\ProductRepository
 */
class ProductEloquentRepository extends EloquentRepository implements ProductRepositoryInterface
{
    /**
     * Get model.
     *
     * @return string
     */
    public function getModel()
    {
        return Product::class;
    }
}
