<?php

namespace App\Services;

use App\Repositories\SupplierRepository\SupplierRepositoryInterface;

/**
 * Class SupplierService
 */
class SupplierService
{
    protected $repository;
    
    public function __construct(SupplierRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function findWhere($query)
    {
        return $this->repository->findWhere($query);
    }

    public function find($id)
    {
        return $this->repository->find($id);
    }
    
    public function store($data)
    {
        $supplier = $this->repository->create($data);
        if (isset($data['logo'])) {
            $this->handleSaveImage($data['logo'], $supplier);
        }
        return $supplier;
    }

    public function delete($id)
    {
        $supplier = $this->repository->find($id);
        $supplier['status'] = 0;
        return $this->repository->update($id, $supplier);
    }

    public function handleSaveImage($image, $supplier)
    {
        $imageName = pathinfo(
            $image->getClientOriginalName(),
            PATHINFO_FILENAME
        ).time().'.'.$image->getClientOriginalExtension();
        $destinationPath = public_path('/images');
        $image->move($destinationPath, $imageName);
        $supplier->update(['logo' => $imageName]);
    }

    public function getAll()
    {
        return $this->repository->getAll();
    }

    public function update($id, $data)
    {
        $supplier = $this->repository->update($id, $data);
        if (isset($data['feature_image'])) {
            $this->handleSaveImage($data['feature_image'], $supplier);
        }
    }

    public function getPaginate()
    {
        return $this->repository->getPaginate();
    }
}
