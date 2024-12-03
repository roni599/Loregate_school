<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseHelper;
use App\Models\ClassModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ClassController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'class_name' => 'required|string|max:255',
            'group' => 'nullable|string|max:255',
            'session' => 'nullable|string|max:255',
            'shift' => 'nullable|string|max:255',
            'section' => 'nullable|string|max:255',
            'status' => 'required|in:active,inactive',
        ]);

        if ($validator->fails()) {
            return ResponseHelper::unprocessableEntity('Validation Error', $validator->errors());
        }

        $class = ClassModel::create([
            'class_name' => $request->input('class_name'),
            'group' => $request->input('group'),
            'session' => $request->input('session'),
            'shift' => $request->input('shift'),
            'section' => $request->input('section'),
            'status' => $request->input('status'),
        ]);

        return ResponseHelper::success($class, 'Class created successfully!', 201);
    }

    public function index()
    {
        $classes = ClassModel::all();
        return ResponseHelper::success($classes, 'Classes data retrive successfully!', 200);
    }

    public function updateStatus(Request $request, $id)
    {
        $class = ClassModel::findOrFail($id);
        $class->status = $request->input('status');
        $class->save();

        return ResponseHelper::success($class, 'Class updated successfully!', 201);
    }
}
