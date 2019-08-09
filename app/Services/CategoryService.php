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
        $category = $this->repository->create($data);
        if ($data['image']) {
            $this->handleSaveImage($data['image'], $category);
        }
        return $category;
    }

    public function delete($id)
    {
        return $this->repository->delete($id);
    }

    public function handleSaveImage($image, $category)
    {
        $imageName = pathinfo(
            $image->getClientOriginalName(),
            PATHINFO_FILENAME
        ).time().'.'.$image->getClientOriginalExtension();
        $destinationPath = public_path('/images');
        $image->move($destinationPath, $imageName);
        $category->update(['image' => $imageName]);
    }
}
