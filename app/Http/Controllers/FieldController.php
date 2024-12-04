<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseHelper;
use App\Models\Field;
use Illuminate\Http\Request;

class FieldController extends Controller
{
    public function index()
    {
        $fields = Field::all();
        return response()->json($fields);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'field_name' => 'required|string|max:255',
            'field_type' => 'required|string|in:text,password,email,select,date,textarea,file,button,number,radio,checkbox',
            'options'    => 'nullable|array',
            'options.*'  => 'string|max:255',
            'required'   => 'boolean'
        ]);

        $field = Field::create([
            'field_name' => $validatedData['field_name'],
            'field_type' => $validatedData['field_type'],
            'options'    => $validatedData['options'] ?? [],
            'required' => $validatedData['required']
        ]);
        return ResponseHelper::success($field,'From fields data created successfully');
    }
}
