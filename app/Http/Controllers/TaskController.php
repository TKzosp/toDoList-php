<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{

    public function index()
    {
        // READ (GET)
        try {
            $task = Task::all();
            return response()->json($task, 200);

        } catch (\Exception $error) {
            return response()->json($error->getMessage(), 500);
        }
    }


    public function store(Request $request)
    {
        // CREATE (POST)
        try {
            Task::create($request->all());
            return response()->json('task created successfully', 201);
        } catch (\Exception $error) {
            return response()->json($error->getMessage(), 500);
        }
    }

    public function update(Request $request, int $id)
    {
        // UPDATE (PUT)
        try {
            $task = Task::find($id);
            $task->update($request->all());
            return response()->json('task updated successfully', 201);

        } catch (\Exception $error) {
            return response()->json($error->getMessage(), 500);
        }
    }

    public function destroy($id)
    {
        // DELETE (DELETE)
        try {
            $task = Task::find($id);
            $task->delete();
            return response()->json('task deleted successfully', 201);
        } catch (\Exception $error) {
            return response()->json($error->getMessage(), 500);
        }
    }
}