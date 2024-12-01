<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseHelper;
use App\Models\BoardNews;
use Illuminate\Http\Request;

class BoardNewsController extends Controller
{
    public function index(){
        $boardNews=BoardNews::all();
        return ResponseHelper::success($boardNews,"Boardnews data successfully retrive successfully");
    }
    public function store(Request $request)
    {
        $request->validate([
            'heading' => 'required|string|max:255',
            'date' => 'required|date',
            'writer' => 'required|string|max:255',
            'data_sources' => 'required|string|max:255',
            'description' => 'required|string',
        ]);
        
        // return response()->json($request->all());
        $boardNews = BoardNews::create([
            'heading' => $request->heading,
            'date' => $request->date,
            'writer' => $request->writer,
            'data_sources' => $request->data_sources,
            'description' => $request->description,
            'academy_id'=>1
        ]);

        return response()->json(['message' => 'Board News created successfully', 'boardNews' => $boardNews], 201);
    }

    public function find($id)
    {
        if (empty($id) || !is_numeric($id)) {
            return response()->json(['message' => 'The academy ID is required and must be an integer.'], 422);
        }
        $boardNews = BoardNews::findOrFail($id);
        return ResponseHelper::success($boardNews, 'Board News data retrieved successfully.');
    }
}
