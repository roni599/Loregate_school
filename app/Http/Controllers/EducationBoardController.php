<?php

namespace App\Http\Controllers;

use App\Helpers\ImageValidator;
use App\Helpers\ResponseHelper;
use App\Models\EducationBoard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EducationBoardController extends Controller
{

    public function index()
    {
        $educationBoard = EducationBoard::first();
        return ResponseHelper::success($educationBoard, "Education Board Data retrive successfully");
    }
    public function storeUpdate(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'education_minister_name' => 'required|string|max:255',
            'education_minister_designation' => 'required|string|max:255',
            'education_minister_image' => 'nullable|string',
            'board_chairman_name' => 'required|string|max:255',
            'board_chairman_designation' => 'required|string|max:255',
            'board_chairman_image' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return ResponseHelper::unprocessableEntity('Validation Error', $validator->errors());
        }

        $educationboard = EducationBoard::first();

        if ($educationboard) {
            if ($request->education_minister_image) {
                if ($educationboard->e_image) {
                    ImageValidator::deleteImage("backend/images/educationboard/" . $educationboard->e_image);
                }
                $savePicture1 = ImageValidator::saveBase64Image($request->education_minister_image, 'backend/images/educationboard/');
                if (!$savePicture1['status']) {
                    return response()->json(['message' => $savePicture1['message']], 422);
                }
                $educationboard->e_image = $savePicture1['image_name'];
            }
            if ($request->board_chairman_image) {
                if ($educationboard->b_image) {
                    ImageValidator::deleteImage("backend/images/educationboard/" . $educationboard->b_image);
                }
                $savePicture2 = ImageValidator::saveBase64Image($request->board_chairman_image, 'backend/images/educationboard/');
                if (!$savePicture2['status']) {
                    if ($request->e_image) {
                        ImageValidator::deleteImage("backend/images/educationboard/" . $savePicture1['image_name']);
                    }
                    return response()->json(['message' => $savePicture2['message']], 422);
                }
                $educationboard->b_image = $savePicture2['image_name'];
            }
            $educationboard->eminister_name = $request->education_minister_name;
            $educationboard->edesignation = $request->education_minister_designation;
            $educationboard->bminister_name = $request->board_chairman_name;
            $educationboard->bdesignation = $request->board_chairman_designation;
            $educationboard->save();

            return ResponseHelper::success($educationboard, "educationboard updated successfully");
        } else {
            $savePicture1 = ImageValidator::saveBase64Image($request->education_minister_image, 'backend/images/educationboard/');
            if (!$savePicture1['status']) {
                return response()->json(['message' => $savePicture1['message']], 422);
            }

            $savePicture2 = ImageValidator::saveBase64Image($request->board_chairman_image, 'backend/images/educationboard/');
            if (!$savePicture2['status']) {
                ImageValidator::deleteImage($savePicture1['image_path']);
                return response()->json(['message' => $savePicture2['message']], 422);
            }
            EducationBoard::create([
                'eminister_name' => $request->education_minister_name,
                'edesignation' => $request->education_minister_designation,
                'e_image' => $educationMinisterImage ?? null,
                'bminister_name' => $request->board_chairman_name,
                'bdesignation' => $request->board_chairman_designation,
                'board_chairman_image' => $boardChairmanImage ?? null,
                'e_image' => $savePicture1['image_name'],
                'b_image' => $savePicture2['image_name'],
                'academy_id' => 1
            ]);

            return response()->json(['message' => 'Education board created successfully!'], 200);
        }
    }


























    public function find($id)
    {
        $educationBoard = EducationBoard::find($id);
        return ResponseHelper::success($educationBoard, "Prime Presedent Data retrive successfully");
    }

    public function update(Request $request)
    {

        $educationboard = EducationBoard::find($request->academy_id)->first();
        if (!$educationboard) {
            return ResponseHelper::notFound('Education board not found.');
        }

        if ($request->education_minister_image) {
            if ($educationboard->e_image) {
                ImageValidator::deleteImage("backend/images/educationboard/" . $educationboard->e_image);
            }
            $savePicture1 = ImageValidator::saveBase64Image($request->education_minister_image, 'backend/images/educationboard/');
            if (!$savePicture1['status']) {
                return response()->json(['message' => $savePicture1['message']], 422);
            }
            $educationboard->e_image = $savePicture1['image_name'];
        }
        if ($request->board_chairman_image) {
            if ($educationboard->b_image) {
                ImageValidator::deleteImage("backend/images/educationboard/" . $educationboard->b_image);
            }
            $savePicture2 = ImageValidator::saveBase64Image($request->board_chairman_image, 'backend/images/educationboard/');
            if (!$savePicture2['status']) {
                if ($request->e_image) {
                    ImageValidator::deleteImage("backend/images/educationboard/" . $savePicture1['image_name']);
                }
                return response()->json(['message' => $savePicture2['message']], 422);
            }
            $educationboard->b_image = $savePicture2['image_name'];
        }
        $educationboard->eminister_name = $request->education_minister_name;
        $educationboard->edesignation = $request->education_minister_designation;
        $educationboard->bminister_name = $request->board_chairman_name;
        $educationboard->bdesignation = $request->board_chairman_designation;
        $educationboard->save();

        return ResponseHelper::success($educationboard, "educationboard updated successfully");
    }
}
