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
        return ResponseHelper::success($fields, 'Student information input fields data retrive successfully');
    }

    // public function studentinformation(){
    //     $field=Field::where
    // }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'field_name' => 'required|string|max:255',
            'field_type' => 'required|string|in:text,password,email,select,date,textarea,file,button,number,radio,checkbox',
            'options'    => 'nullable|array',
            'options.*'  => 'string|max:255',
            'required'   => 'boolean',
            'formname'  => 'required|integer'
        ]);

        $field = Field::create([
            'field_name' => $validatedData['field_name'],
            'field_type' => $validatedData['field_type'],
            'options'    => $validatedData['options'] ?? [],
            'required' => $validatedData['required'],
            'form_name_id' => $validatedData['formname'],
        ]);
        return ResponseHelper::success($field, 'From fields data created successfully');
    }

    public function updateStatus(Request $request, $id)
    {
        $field = Field::findOrFail($id);
        $field->status = $request->input('status');
        $field->save();

        return ResponseHelper::success($field, 'Field updated successfully!', 201);
    }

    public function statusIndex()
    {
        $fields = Field::where('status', 1)->get();
        return ResponseHelper::success($fields, 'Student information input fields data retrieved successfully');
    }
}
