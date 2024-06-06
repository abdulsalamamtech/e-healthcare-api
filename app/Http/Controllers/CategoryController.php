<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::paginate(20)->withQueryString();
        $metaData = $this->getMetadata($categories);
        $categories->load(['createdBy']);

        $categories = CategoryResource::collection($categories);
        return $this->sendSuccess($categories, metadata: $metaData);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        $category = Category::create($request->all());
        $category = new CategoryResource($category);
        return $this->sendSuccess($category, 'category created successfully');

    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        $category = new CategoryResource($category);
        return $this->sendSuccess($category, );;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $category->update(($request->all()));
        $category = new CategoryResource($category);

        return $this->sendSuccess($category, 'category updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return $this->sendSuccess([], 'category deleted successfully');

    }
}
