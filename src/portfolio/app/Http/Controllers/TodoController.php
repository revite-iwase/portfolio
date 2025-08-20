<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TodoController extends Controller
{
    /**
     * Display a listing of the user's todos.
     */
    public function index()
    {
        $todos = Todo::where('user_id', Auth::id())
            ->orderByRaw("FIELD(priority, 'high', 'medium', 'low')")
            ->orderBy('due_date')
            ->get();

        return response()->json($todos);
    }

    /**
     * Store a newly created todo in storage.
     */
    public function store(Request $request)
    {
        $todo = Todo::create([
            'user_id' => Auth::id(),
            'task_name' => $request->input('task_name'),
            'due_date' => $request->input('due_date'),
            'priority' => $request->input('priority', 'low'),
        ]);

        return response()->json($todo, 201);
    }

    /**
     * Mark the specified todo as complete.
     */
    public function complete(Todo $todo)
    {
        if ($todo->user_id !== Auth::id()) {
            abort(403);
        }

        $todo->update(['is_complete' => true]);
        return response()->json($todo);
    }
}
