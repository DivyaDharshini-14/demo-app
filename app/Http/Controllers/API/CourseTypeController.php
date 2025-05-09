<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\CoursesType;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CourseTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        return response()->json(CoursesType::with('category')->latest()->paginate(10), 200);
    }

    // Store a new course type
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:courses_types,name',
            'category_id' => 'required|exists:categories,id',
        ]);

        $courseType = CoursesType::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'category_id' => $request->category_id,
        ]);

        return response()->json(['message' => 'Course type created', 'data' => $courseType], 201);
    }

    // Show a single course type
    public function show($id)
    {
        $courseType = CoursesType::with('category')->find($id);

        if (!$courseType) {
            return response()->json(['message' => 'Course type not found'], 404);
        }

        return response()->json($courseType);
    }

    // Update a course type
    public function update(Request $request, $id)
    {
        $courseType = CoursesType::find($id);

        if (!$courseType) {
            return response()->json(['message' => 'Course type not found'], 404);
        }

        $request->validate([
            'name' => 'required|string|max:255|unique:courses_types,name,' . $id,
            'category_id' => 'required|exists:categories,id',
        ]);

        $courseType->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'category_id' => $request->category_id,
        ]);

        return response()->json(['message' => 'Course type updated', 'data' => $courseType]);
    }

    // Delete a course type
    public function destroy($id)
    {
        $courseType = CoursesType::find($id);

        if (!$courseType) {
            return response()->json(['message' => 'Course type not found'], 404);
        }

        $courseType->delete();

        return response()->json(['message' => 'Course type deleted']);
    }

}
