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
     * Show the form for creating a new resource.
     */
    public function todo(Request $request)
    {
        $todo = Todo::create([
            'name' => $request->name,
        ]);
    }
}
