<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    /**
     * Display view of todo.
     */
    public function index()
    {
        return view('welcome',['todos' => Todo::orderby('id', 'desc')->get()]);
    }

    /**
     * Function for creating a new resource.
     */
    public function todo(Todo $todo)
    {
        $add_todo = Todo::create([
            'name' => $todo->name,
        ]);
    }

    /**
     * Function for editing a resource.
     */
    public function edit(Todo $todo)
    {
        // $edit_todo = Todo::find($todo->id);
        return response()->json($todo);
    }

    /**
     * Function for deleting a resource.
     */
    public function delete(Todo $todo)
    {
        $delete_todo = Todo::find($todo->id);
    }

    public function store()
    {
        $todo = Todo::updateOrCreate(
            ['id' => request()->id],
            ['name' => request()->name],
        );

        return response()->json($todo);
    }
}
