<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use App\Models\Task;
use App\Models\TaskTag;
use App\Http\Requests\TaskStoreRequest;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $tasks = Task::with(['tags', 'category'])->get();
            return response()->json(['data' => $tasks]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to fetch tasks'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TaskStoreRequest $request)
    {
        $validData = $request->validated();

        try {
            $task = Task::create($validData);
            if (!empty($tags)) {
                foreach ($tags as $tagId) {
                    TaskTag::create([
                        'task_id' => $task->id,
                        'tag_id' => $tagId
                    ]);
                }
            }
            return response()->json(['data' => $task]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to create task'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TaskStoreRequest $request, Task $task)
    {
        $validData = $request->validated();

        try {
            DB::beginTransaction();
            $task->update($validData);
            $task->tags()->sync($validData['tags']);
            DB::commit();
            return response()->json(['data' => $task]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => 'Failed to update task'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        try {
            DB::beginTransaction();
            $task->delete();
            DB::commit();
            return response()->json(['data' => 'Task deleted successfully']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => 'Failed to delete task'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
