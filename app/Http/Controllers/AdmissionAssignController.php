<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseHelper;
use App\Models\AdmissionAssign;
use Illuminate\Http\Request;

class AdmissionAssignController extends Controller
{
    public function index()
    {
        $admissionassign = AdmissionAssign::all();
        return ResponseHelper::success($admissionassign, "Admission Assign data retrive successfully");
    }
    public function store(Request $request)
    {
        $request->validate([
            'class_name' => 'required|string|max:255',
            'class_details' => 'required|string|max:255',
            'start_date' => 'required|date',
            'start_time' => 'required|date_format:H:i',
            'end_date' => 'required|date',
            'end_time' => 'required|date_format:H:i',
            'qty' => 'nullable|integer',
            'male_qty' => 'nullable|integer',
            'female_qty' => 'nullable|integer',
            'fee' => 'required|numeric',
            'payment_type' => 'required|string|max:255',
        ]);
        $admissionAssign = AdmissionAssign::create([
            'class_name' => $request->class_name,
            'class_details' => $request->class_details,
            'start_date' => $request->start_date,
            'start_time' => $request->start_time,
            'end_date' => $request->end_date,
            'end_time' => $request->end_time,
            'qty' => $request->qty,
            'male_qty' => $request->male_qty,
            'female_qty' => $request->female_qty,
            'fee' => $request->fee,
            'payment_type' => $request->payment_type,
        ]);

        // Return success response
        return response()->json(['message' => 'Admission successfully assigned', 'data' => $admissionAssign], 201);
        return response()->json($request->all());
    }
    public function admissionstore(Request $request)
    {
        return response()->json($request->all());
    }
}
