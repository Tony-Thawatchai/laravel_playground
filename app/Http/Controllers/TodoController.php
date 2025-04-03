<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\todo;
use Inertia\Inertia;

class TodoController extends Controller
{
    public function index()
    {
        // Logic to fetch all todo items

        // Fetch todos with their associated user
        $todos = Todo::with('user') // Eager load the user relationship
            ->orderBy('created_at', 'desc')
            ->paginate(10);



        // Render the Inertia.js component
        return Inertia::render('todos/index', ['todos' => $todos]);
    }

    public function create()
    {
        return view('todos.create');
    }

    public function store(Request $request)
    {
        // Logic to store the todo item
        return redirect()->route('todos.index');
    }

    public function show($id)
    {
        return view('todos.show', compact('id'));
    }

    public function edit($id)
    {
        return view('todos.edit', compact('id'));
    }

    public function update(Request $request, $id)
    {
        // Logic to update the todo item
        return redirect()->route('todos.index');
    }

    public function destroy($id)
    {
        // Logic to delete the todo item
        return redirect()->route('todos.index');
    }

    public function toggleComplete(Request $request, $id)
    {
        $todo = Todo::findOrFail($id);
        $todo->is_complete = $request->is_complete;
        $todo->save();

        return redirect()->back()->with('success', 'Todo updated successfully.');
    }
}
