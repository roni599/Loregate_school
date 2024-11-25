<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseHelper;
use App\Models\StaffData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StaffDataController extends Controller
{
    public function index()
    {
        $staffDataId = StaffData::first();
        return ResponseHelper::success($staffDataId, 'Academy StaffData Retrive successfully!');
    }
    
    public function storeUpdate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'teacher_staff_qty' => 'required|integer',
            'student_qty' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return ResponseHelper::unprocessableEntity('Validation Error', $validator->errors());
        }

        $staffData = StaffData::first();

        if ($staffData) {
            $staffData->update([
                'teacher_staff_qty' => $request->input('teacher_staff_qty'),
                'student_qty' => $request->input('student_qty'),
            ]);
            return ResponseHelper::success($staffData, 'Academy StaffData Updated successfully!');
        } else {
            StaffData::create([
                'teacher_staff_qty' => $request->input('teacher_staff_qty'),
                'student_qty' => $request->input('student_qty'),
            ]);
            return response()->json(['message' => 'Data saved successfully']);
        }
    }










    public function find($id)
    {
        $staffDataId = StaffData::findOrFail($id);
        return ResponseHelper::success($staffDataId, 'Academy StaffData Retrive successfully!');
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'teacher_staff_qty' => 'required|integer',
            'student_qty' => 'required|integer',
            'staffData_id' => 'required'
        ]);

        if ($validator->fails()) {
            return ResponseHelper::unprocessableEntity('Validation Error', $validator->errors());
        }
        $staffData = StaffData::find($request->staffData_id);

        if ($staffData) {
            $staffData->update([
                'teacher_staff_qty' => $request->input('teacher_staff_qty'),
                'student_qty' => $request->input('student_qty'),
            ]);

            return ResponseHelper::success($staffData, 'Academy StaffData Updated successfully!');
        } else {

            return ResponseHelper::notFound('Staff data not found');
        }
    }
}
