<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Services\CategoryService;

class UpdateCategories extends FormRequest
{

    protected $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }
    
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $categories = $this->categoryService->getAll();
        $parent_id = [];
        foreach($categories as $category)
        {
            $parent_id[] = $category->id;
        }   
        return [
            'name' => 'required|max:250',
            'description' => 'nullable|max:1000',
            'slug' => 'required|max:250',
            'status' => 'required|in:' . implode(',', array_keys(__('category.status.option'))),
            'parent_id' => 'nullable|in:'.implode(',', $parent_id),
        ];
    }
}
