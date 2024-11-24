<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseHelper;
use App\Models\Magazine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MagazineController extends Controller
{

    public function index()
    {
        $magazine = Magazine::all();
        return ResponseHelper::success($magazine, "Magazine Data retrive successfully");
    }

    public function find($id){
        $magazineListview=Magazine::findOrFail($id);
        return ResponseHelper::success($magazineListview,"Magazine data retrive successfully");
    }

    public function store(Request $request)
    {
        // Validate the incoming data
        $validator = Validator::make($request->all(), [
            'subject' => 'required|string|max:255',
            'heading' => 'required|string|max:255',
            'writer' => 'required|string|max:255',
            'data_sources' => 'required|string|max:255',
            'description' => 'required|string',
            'date' => 'required|date',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation Error',
                'errors' => $validator->errors()
            ], 422);
        }

        // Store the data in the database
        $magazine = Magazine::create([
            'subject' => $request->input('subject'),
            'heading' => $request->input('heading'),
            'writer' => $request->input('writer'),
            'data_sources' => $request->input('data_sources'),
            'description' => $request->input('description'),
            'date' => $request->input('date'),
            'academy_id' => 1
        ]);

        return response()->json([
            'message' => 'Magazine created successfully!',
            'data' => $magazine
        ]);
    }
}
