<?php

namespace App\Http\Controllers;

use App\Models\AcademyHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Helpers\ResponseHelper;

class AcademyHistoryController extends Controller
{
    public function index()
    {
        $academyHistory = AcademyHistory::first();
        return ResponseHelper::success($academyHistory, 'Academy History Data Retrive successfully!');
    }
    public function storeUpdate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'history' => 'required|string|max:5000',
        ]);

        if ($validator->fails()) {
            return ResponseHelper::unprocessableEntity('Validation Error', $validator->errors());
        }

        $academyHistory = AcademyHistory::first();

        if ($academyHistory) {
            $academyHistory->history = $request->input('history');
            $academyHistory->save();
            return ResponseHelper::success($academyHistory, 'Academy History Updated Successfully!');
        } else {
            $academyHistory = AcademyHistory::create([
                'history' => $request->input('history'),
            ]);
            return ResponseHelper::success($academyHistory, 'Academy History Created successfully!');
        }
    }






























    public function find($id)
    {
        $academyHistory = AcademyHistory::findOrFail($id);
        return ResponseHelper::success($academyHistory, 'Academy History Data Retrive successfully!');
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'history' => 'required|string|max:1000',
            'academyHistory_id' => 'required'
        ]);

        if ($validator->fails()) {
            return ResponseHelper::unprocessableEntity('Validation Error', $validator->errors());
        }
        $academyHistory = AcademyHistory::find($request->academyHistory_id);

        if (!$academyHistory) {
            return ResponseHelper::notFound('Academy History not found');
        }
        $academyHistory->history = $request->input('history');
        $academyHistory->save();
        return ResponseHelper::success($academyHistory, 'Academy History Updated Successfully!');
    }
}
