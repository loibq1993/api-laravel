<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CategoryService;
use App\Http\Requests\CreateCategories;
use App\Http\Requests\UpdateCategories;

class CategoryController extends Controller
{
    protected $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }    
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $where = ['status','=', array_keys(__('category.status.option'))[1]];
        $categories = $this->categoryService->findWhere([$where])->paginate(10);
        return view('category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = $this->categoryService->getAll();
        return view('category.backend.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateCategories $request)
    {
        $data = $request->only([
            'name' => $request->name,
            'slug' => $request->slug,
            'description' => $request->description,
            'status' => $request->status,
            'parent_id' => $request->parent,
            'feature_image' => $request->feature_image,
        ]);
        $this->categoryService->store($data);
        
        return redirect()->route('category.index')->with('message', __('category.message.create.success')); 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Categories  $categories
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
    
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Categories  $categories
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = $this->categoryService->find($id);
        $categories = $this->categoryService->getAll();

        return view('category.backend.edit', compact('category', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Categories  $categories
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategories $request, $id)
    {
        $data = $request->all();
        $this->categoryService->update($id, $data);
        
        return redirect()->route('category.index')->with('message', __('category.message.edit.success')); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Categories  $categories
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = $this->categoryService->find($id);
        $data['status'] = 0;
        $this->categoryService->update($id, $data);
        return redirect()->route('category.index')->with('message', __('category.message.delete.success')); 
    }
}
