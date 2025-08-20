<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    /**
     * Display a listing of todos.
     */
    public function index()
    {
        return response()->json(Todo::with('user')->get());
    }

    /**
     * Store a newly created todo in storage.
     */
    public function store(Request $request)
    {
        $todo = Todo::create($request->all());
        return response()->json($todo, 201);
    }

    /**
     * Update the specified todo in storage.
     */
    public function update(Request $request, Todo $todo)
    {
        $todo->update($request->all());
        return response()->json($todo);
    }

    /**
     * Remove the specified todo from storage.
     */
    public function destroy(Todo $todo)
    {
        $todo->delete();
        return response()->json();
    }
}
