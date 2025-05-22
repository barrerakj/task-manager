<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use App\Models\Tag;
use App\Http\Requests\TagStoreRequest;

class TagController extends Controller
{
     /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $tags = Tag::all();
            return response()->json($tags);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to fetch tags'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TagStoreRequest $request)
    {
        $validData = $request->validated();

        try {
            $tag = Tag::create($validData);
            return response()->json($tag);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to create tag'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TagStoreRequest $request, Tag $tag)
    {
        $validData = $request->validated();

        try {
            DB::beginTransaction();
            $tag->update($validData);
            DB::commit();
            return response()->json($tag);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => 'Failed to update tag'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tag $tag)
    {
        try {
            DB::beginTransaction();
            $tag->delete();
            DB::commit();
            return response()->json('Tag deleted successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => 'Failed to delete tag'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}