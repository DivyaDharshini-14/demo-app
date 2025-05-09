<?php

use App\Http\Controllers\API\AuthorController;
use App\Http\Controllers\API\CourseController;
use App\Http\Controllers\API\CourseTypeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\CategoryController;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('categories', CategoryController::class);
Route::apiResource('authors', AuthorController::class);
Route::apiResource('courseTypes/{id}', CourseTypeController::class);
Route::apiResource('courses', CourseController::class);
