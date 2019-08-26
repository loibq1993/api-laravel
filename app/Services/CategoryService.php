<?php

namespace App\Services;

use App\Repositories\CategoryRepository\CategoryRepositoryInterface;

/**
 * Class CategoryService
 */
class CategoryService
{
    protected $repository;
    
    public function __construct(CategoryRepositoryInterface $repository)
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
        $category = $this->repository->create($data);
        if (isset($data['feature_image'])) {
            $this->handleSaveImage($data['feature_image'], $category);
        }
        return $category;
    }

    public function delete($id)
    {
        $category = $this->repository->find($id);
        $category['status'] = 0;
        return $this->repository->update($id, $category);
    }

    public function handleSaveImage($image, $category)
    {
        $imageName = pathinfo(
            $image->getClientOriginalName(),
            PATHINFO_FILENAME
        ).time().'.'.$image->getClientOriginalExtension();
        $destinationPath = public_path('/images');
        $image->move($destinationPath, $imageName);
        $category->update(['feature_image' => $imageName]);
    }

    public function getAll()
    {
        return $this->repository->getAll(10);
    }

    public function update($id, $data)
    {
        $category = $this->repository->update($id, $data);
        if (isset($data['feature_image'])) {
            $this->handleSaveImage($data['feature_image'], $category);
        }
    }
}
