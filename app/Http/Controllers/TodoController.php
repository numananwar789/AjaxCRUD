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
     * Function for creating and updating a resource.
    */
    public function store()
    {
        $todo = Todo::updateOrCreate(
            ['id' => request()->id],
            ['name' => request()->name],
        );

        return response()->json($todo);
    }

    /**
     * Function for editing a resource.
    */

    function edit(Todo $todo) {
        return response()->json($todo);
    }

    /**
     * Function for deleting a resource.
     */
    public function delete(Todo $todo)
    {
        $todo->delete();
        return response()->json('success');
    }
}
