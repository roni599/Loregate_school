<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseHelper;
use App\Models\ClassInformation;
use GuzzleHttp\Psr7\Request as Psr7Request;
use GuzzleHttp\Psr7\Response;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Request as HttpFoundationRequest;

class ClassInformationController extends Controller
{
    public function index()
    {
        $classInformation = ClassInformation::all();
        return ResponseHelper::success($classInformation, "ClassInformation data retrive successfully");
    }
    public function store(Request $request)
    {
        // return response()->json($request->all());
        $request->validate([
            'class_id' => 'required|integer',
            'information' => 'required|string|max:300',
            // 'date' => 'required|string|max:300',
        ]);

        $classInformation = ClassInformation::create([
            'assign_class_id' => $request->class_id,
            'information' => $request->information,
            'date' => $request->date,
        ]);
        return ResponseHelper::success($classInformation, "ClassInformation created successfully");
    }


}
