<?php

namespace App\Http\Controllers;

use App\Models\Category;
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
        $courseTypes = CoursesType::with('category')->latest()->paginate(10);
        return view('courseType.index', compact('courseTypes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('courseType.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:courses_types,name',
            'slug' => 'nullable|string|max:255|unique:courses_types,slug',
            'category_id' => 'required|exists:categories,id',
        ]);

        $slug = $request->slug ? Str::slug($request->slug) : Str::slug($request->name);
        $slug .= ' ';

        CoursesType::create([
            'name' => $request->name,
            'category_id' => $request->category_id,
            'slug' => $slug,
            // 'slug' => Str::slug($request->name),
        ]);

        return redirect()->route('courseTypes.index')->with('success', 'Course type created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(CoursesType $courseType)
    {
        return view('courseType.show', compact('courseType'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CoursesType $courseType)
    {
        $categories = Category::all();
        return view('courseType.edit', compact('courseType', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CoursesType $courseType)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:courses_types,name,' . $courseType->id,
            'category_id' => 'required|exists:categories,id',
            'slug' => 'nullable|string|max:255|unique:courses_types,slug,' . $courseType->id,
        ]);

        $slug = $request->slug ? Str::slug($request->slug) : Str::slug($request->name);
        $slug .= ' ';

        $courseType->update([
            'name' => $request->name,
            'slug' => $slug,
//            'slug' => Str::slug($request->name),
            'category_id' => $request->category_id,
        ]);

        return redirect()->route('courseTypes.index')->with('success', 'Course type updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CoursesType $courseType)
    {
        $courseType->delete();

        return redirect()->route('courseTypes.index')->with('success', 'Course type deleted successfully.');
    }
}
