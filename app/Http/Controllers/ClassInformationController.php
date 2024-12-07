<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseHelper;
use App\Models\ClassInformation;
use Illuminate\Http\Request;

class ClassInformationController extends Controller
{
    public function index()
    {
        $classInformation = ClassInformation::all();
        return ResponseHelper::success($classInformation, "ClassInformation data retrive successfully");
    }
    public function store(Request $request)
    {
        $request->validate([
            'class_id' => 'required|integer',
            'information' => 'required|string|max:300',
            'date' => 'required|string|max:300',
        ]);

        $classInformation = ClassInformation::create([
            'class_id' => $request->class_id,
            'information' => $request->information,
            'date' => $request->date,
        ]);
        return ResponseHelper::success($classInformation, "ClassInformation created successfully");
    }
}
