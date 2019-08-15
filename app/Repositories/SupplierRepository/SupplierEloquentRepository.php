<?php

namespace App\Repositories\SupplierRepository;

use App\Models\Supplier;
use App\Repositories\EloquentRepository;

/**
 * Class SupplierEloquentRepository
 * @package App\Repositories\SupplierRepository
 */
class SupplierEloquentRepository extends EloquentRepository implements SupplierRepositoryInterface
{
    /**
     * Get model.
     *
     * @return string
     */
    public function getModel()
    {
        return Supplier::class;
    }
}
