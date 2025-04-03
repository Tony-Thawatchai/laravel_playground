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

        // Render the Inertia.js component for creating a new todo
        return Inertia::render('todos/create', [
            'users' => \App\Models\User::all(), // Fetch all users for the select dropdown
        ]);
    }

    public function store(Request $request)
    {
        // Logic to store a new todo item
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'nullable|date',
            'user_id' => 'required|exists:users,id',
        ]);

        // Create a new todo item
        Todo::create([
            'title' => $request->title,
            'description' => $request->description,
            'due_date' => $request->due_date,
            'is_complete' =>  false, 
            'user_id' => $request->user_id,
        ]);

        // Redirect back to the todos index page with a success message
        return redirect()->route('todos.index')->with('success', 'Todo created successfully.');
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
