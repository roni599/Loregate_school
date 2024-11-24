<?php

namespace App\Http\Controllers;

use App\Helpers\ImageValidator;
use App\Helpers\ResponseHelper;
use App\Models\BoardNotice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BoardNoticeController extends Controller
{
    public function index()
    {
        $boardNotice = BoardNotice::all();
        return ResponseHelper::success($boardNotice,"Board Notice Data Retrive Successfully");
    }

    public function find($id){
        $boardNotice=BoardNotice::findOrFail($id);
        return ResponseHelper::success($boardNotice,'Board Notice data retrive successfully');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'date' => 'required|date',
            'reference' => 'required|integer',
            'subject' => 'required|string|max:255',
            'description' => 'required|string',
            'signature' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return ResponseHelper::unprocessableEntity('Validation Error', $validator->errors());
        }

        $signaturePath = null;
        if ($request->has('signature') && $request->signature) {
            $saveImage = ImageValidator::saveBase64Image($request->signature,  'backend/images/boardNotice/');
            if (!$saveImage['status']) {
                return ResponseHelper::unprocessableEntity($saveImage['message']);
            }
            $signaturePath = $saveImage['image_name'];
        }

        $websitelink = new BoardNotice();
        $websitelink->date = $request->date;
        $websitelink->reference = $request->reference;
        $websitelink->subject = $request->subject;
        $websitelink->description = $request->description;
        $websitelink->academy_id = 1;
        $websitelink->signature = $signaturePath;
        $websitelink->save();

        return response()->json([
            'message' => 'Notice Board saved successfully.',
            'data' => $websitelink,
        ], 201);
    }

   
}
