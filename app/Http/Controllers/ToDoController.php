<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ToDo;

class ToDoController extends Controller
{
    public function index()
    {
        $todos = ToDo::where('is_completed', false)->get();
        return view('todos.index', compact('todos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
        ]);

        if (ToDo::uniqueTitle($request->title)) {
            return response()->json(['error' => 'Task already exists.'], 422);
        }

        $todo = ToDo::create($request->all());
        return response()->json($todo);
    }

    public function complete($id)
    {
        $todo = ToDo::find($id);
        $todo->is_completed = true;
        $todo->save();

        return response()->json(['success' => 'Task completed successfully.']);
    }

    public function destroy($id)
    {
        $todo = ToDo::find($id);
        $todo->delete();

        return response()->json(['success' => 'Task deleted successfully.']);
    }

    public function showAll()
    {
        $todos = ToDo::all();
        return response()->json($todos);
    }
}
