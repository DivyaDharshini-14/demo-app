<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class TodoController extends Controller
{
    public function index()
    {
        // Fetch data from external API
        $response = Http::get('https://jsonplaceholder.typicode.com/todos/');

        // Decode the JSON response
        $todos = $response->json();

        // Return view with todos
        return view('todos.index', compact('todos'));
    }
}
