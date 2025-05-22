<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use App\Models\Category;
use App\Http\Requests\CategoryStoreRequest;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $categories = Category::all();
            return response()->json(['data' => $categories]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to fetch categories'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryStoreRequest $request)
    {
        $validData = $request->validated();

        try {
            $category = Category::create($validData);
            return response()->json(['data' => $category]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to create the category'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryStoreRequest $request, Category $category)
    {
        $validData = $request->validated();

        try {
            DB::beginTransaction();
            $category->update($validData);
            DB::commit();
            return response()->json(['data' => $category]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => 'Failed to update category'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        try {
            DB::beginTransaction();
            $category->delete();
            DB::commit();
            return response()->json(['data' => 'Category deleted successfully']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => 'Failed to delete category'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}