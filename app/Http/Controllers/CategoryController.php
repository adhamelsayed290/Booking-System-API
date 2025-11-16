<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        return CategoryResource::collection(Category::paginate(10));
    }
    public function show(Category $category)
    {
        return new CategoryResource($category);
    }
    public function store(CategoryRequest $request)
    {
        $data = $request->validated();
        $category = Category::create($data);
        return new CategoryResource($category);
    }
    public function update(CategoryRequest $request, Category $category)
    {
        $data = $request->validated();
        $category->update($data);
        return new CategoryResource($category);
    }
    public function destroy(Category $category)
    {
        $category->delete();
        return response()->json(
            [
                'message' => 'Category deleted successfully'
            ],
            200
        );
    }
    public function toggle(Category $category)
    {
        $category->is_active = !$category->is_active;
        $category->save();
        return new CategoryResource($category);
    }
}
