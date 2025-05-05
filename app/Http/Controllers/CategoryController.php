<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    // Display all categories
    public function index()
    {
        $categories = Category::latest()->paginate(10);
        return view('categories.index', compact('categories'));
    }

    // Show form to create a new category
    public function create()
    {
        return view('categories.create');
    }

    // Store a new category
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
            'slug' => 'nullable|string|max:255|unique:categories,slug',
        ]);

        $slug = $request->slug ? Str::slug($request->slug) : Str::slug($request->name);
        $slug .= ' ';

        Category::create([
            'name' => $request->name,
            'slug' => $slug,
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('categories.index')->with('success', 'Category created successfully.');
    }




    // Show single category (optional)
    public function show(Category $category)
    {
        return view('categories.show', compact('category'));
    }

    // Show form to edit a category
    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    // Update the category
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $category->id,
            'slug' => 'nullable|string|max:255|unique:categories,slug,' . $category->id,
        ]);

        $slug = $request->slug ? Str::slug($request->slug) : Str::slug($request->name);
        $slug .= ' ';

        $category->update([
            'name' => $request->name,
            'slug' => $slug,
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('categories.index')->with('success', 'Category updated successfully.');
    }


    // Delete the category
    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('categories.index')->with('success', 'Category deleted successfully.');
    }
}
