<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseHelper;
use App\Models\TermsCondition;
use Illuminate\Http\Request;

class TermsConditionController extends Controller
{
    public function index()
    {
        $termscondition = TermsCondition::first();
        return ResponseHelper::success($termscondition, "Terms and condition data retrive successfully");
    }
    public function storeUpdate(Request $request)
    {
        $request->validate([
            'content' => 'required|string|max:400',
        ]);

        $termscondition = TermsCondition::first();

        if ($termscondition) {
            $termscondition->update([
                'content' => $request->input('content'),
            ]);

            return ResponseHelper::success($termscondition, "Terms and condition updated successfully");
        } else {
            $termscondition = TermsCondition::create([
                'content' => $request->input('content'),
            ]);
            return ResponseHelper::success($termscondition, "Terms and condition created successfully");
        }
    }
}
