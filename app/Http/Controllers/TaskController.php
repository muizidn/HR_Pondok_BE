<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TaskController extends Controller
{

    public function update(Request $request, $taskId)
    {
        $request->validate([
            'status' => 'required|string',
        ]);

        return response()->json([
            'status' => 'success',
            'data' => [
                'id' => $taskId,
                'status' => $request->status,
            ],
        ]);
    }

    public function index(Request $request)
    {
        return response()->json([
            'status' => 'success',
            'data' => [
                [
                    "id" => 1,
                    "title" => "Task 1"
                ]
            ],
        ]);
    }
}
