<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Courses;
use App\Models\CoursesType;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $courses = Courses::with(['category', 'courseType', 'author', 'user'])->latest()->paginate(10);
        return view('courses.index', compact('courses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        $courseTypes = CoursesType::all();
        $users = User::all();
        return view('courses.create', compact('categories', 'courseTypes', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'course_type_id' => 'required|exists:courses_types,id',
            'name' => 'nullable|required|string|max:255',
            'description' => 'nullable|required|string',
            'thumbnail' => 'nullable|required|image',
            'video' => 'nullable|required|url',
            'author_id' => 'required|exists:users,id',
            'user_id' => 'required|exists:users,id',
        ]);

        $thumbnailPath = $request->file('thumbnail')->store('thumbnails', 'public');

        Courses::create([
            'category_id' => $request->category_id,
            'course_type_id' => $request->course_type_id,
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description' => $request->description,
            'thumbnail' => $thumbnailPath,
            'video' => $request->video,
            'author_id' => $request->author_id,
            'user_id' => $request->user_id,
        ]);

        return redirect()->route('courses.index')->with('success', 'Course created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(courses $courses)
    {
        return view('courses.show', compact('courses'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(courses $course)
    {
        $categories = Category::all();
        $courseTypes = CoursesType::all();
        $users = User::all();
        return view('courses.edit', compact('course', 'categories', 'courseTypes', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, courses $course)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'course_type_id' => 'required|exists:courses_types,id',
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'thumbnail' => 'nullable|image',
            'video' => 'nullable|required|url',
            'author_id' => 'required|exists:users,id',
            'user_id' => 'required|exists:users,id',
        ]);

        if ($request->hasFile('thumbnail')) {
            $thumbnailPath = $request->file('thumbnail')->store('thumbnails', 'public');
        } else {
            $thumbnailPath = $course->thumbnail;
        }

        $course->update([
            'category_id' => $request->category_id,
            'course_type_id' => $request->course_type_id,
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description' => $request->description,
            'thumbnail' => $thumbnailPath,
            'video' => $request->video,
            'author_id' => $request->author_id,
            'user_id' => $request->user_id,
        ]);

        return redirect()->route('courses.index')->with('success', 'Course updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(courses $course)
    {
        $course->delete();
        return redirect()->route('courses.index')->with('success', 'Course deleted successfully.');
    }
}
