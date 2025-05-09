<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Courses;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Courses::all(), 200);
    }

    // Store a new course
    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'course_type_id' => 'required|exists:courses_types,id',
            'name' => 'required|string|max:255|unique:courses,name',
            'description' => 'nullable|string',
            'thumbnail' => 'nullable|string',
            'video' => 'nullable|string',
            'author_id' => 'required|exists:authors,id',
            'user_id' => 'required|exists:users,id',
        ]);

        $course = Courses::create([
            'category_id' => $request->category_id,
            'course_type_id' => $request->course_type_id,
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description' => $request->description,
            'thumbnail' => $request->thumbnail,
            'video' => $request->video,
            'author_id' => $request->author_id,
            'user_id' => $request->user_id,
        ]);

        return response()->json(['message' => 'Course created', 'data' => $course], 201);
    }

    // Show a single course
    public function show($id)
    {
        $course = Courses::find($id);

        if (!$course) {
            return response()->json(['message' => 'Course not found'], 404);
        }

        return response()->json($course);
    }

    // Update a course
    public function update(Request $request, $id)
    {
        $course = Courses::find($id);

        if (!$course) {
            return response()->json(['message' => 'Course not found'], 404);
        }

        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'course_type_id' => 'required|exists:courses_types,id',
            'name' => 'required|string|max:255|unique:courses,name,' . $id,
            'description' => 'nullable|string',
            'thumbnail' => 'nullable|string',
            'video' => 'nullable|string',
            'author_id' => 'required|exists:authors,id',
            'user_id' => 'required|exists:users,id',
        ]);

        $course->update([
            'category_id' => $request->category_id,
            'course_type_id' => $request->course_type_id,
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description' => $request->description,
            'thumbnail' => $request->thumbnail,
            'video' => $request->video,
            'author_id' => $request->author_id,
            'user_id' => $request->user_id,
        ]);

        return response()->json(['message' => 'Course updated', 'data' => $course]);
    }

    // Delete a course
    public function destroy($id)
    {
        $course = Courses::find($id);

        if (!$course) {
            return response()->json(['message' => 'Course not found'], 404);
        }

        $course->delete();

        return response()->json(['message' => 'Course deleted']);
    }
}
