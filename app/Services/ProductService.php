<?php

namespace App\Services;

use App\Repositories\ProductRepository\ProductRepositoryInterface;

/**
 * Class ProductService
 */
class ProductService
{
    protected $repository;
    
    public function __construct(ProductRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function getAll()
    {
        return $this->repository->getAll();
    }

    public function find($id)
    {
        return $this->repository->find($id);
    }
    
    public function store($data)
    {
        $product = $this->repository->create($data);
        if ($data['image']) {
            $this->handleSaveImage($data['image'], $product);
        }
        return $product;
    }

    public function delete($id)
    {
        return $this->repository->delete($id);
    }

    public function handleSaveImage($image, $product)
    {
        $imageName = pathinfo(
            $image->getClientOriginalName(),
            PATHINFO_FILENAME
        ).time().'.'.$image->getClientOriginalExtension();
        $destinationPath = public_path('/images');
        $image->move($destinationPath, $imageName);
        $product->update(['image' => $imageName]);
    }
}
