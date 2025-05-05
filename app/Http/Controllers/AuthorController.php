<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $authors = Author::latest()->paginate(10);
        return view('author.index', compact('authors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('author.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:authors,name',
        ]);

        Author::create([
            'name' => $request->name,
//            'slug' => Str::slug($request->name),
//            'user_id' => auth()->id(), // assuming user is logged in
        ]);

        return redirect()->route('authors.index')->with('success', 'Author created successfully.');
    }
    /**
     * Display the specified resource.
     */
    public function show(author $author)
    {
        return view('author.show', compact('author'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(author $author)
    {
        return view('author.edit', compact('author'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, author $author)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $author->id,
        ]);

        $author->update([
            'name' => $request->name,
//            'slug' => Str::slug($request->name),
        ]);

        return redirect()->route('authors.index')->with('success', 'Category updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(author $author)
    {
        $author->delete();

        return redirect()->route('authors.index')->with('success', 'Category deleted successfully.');
    }

}
