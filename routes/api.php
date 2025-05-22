<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::apiResource('tasks', \App\Http\Controllers\TaskController::class)
    ->only(['index', 'store', 'update', 'destroy']);


Route::apiResource('tags', \App\Http\Controllers\TagController::class)
    ->only(['index', 'store', 'update', 'destroy']);


Route::apiResource('categories', \App\Http\Controllers\CategoryController::class)
    ->only(['index', 'store', 'update', 'destroy']);