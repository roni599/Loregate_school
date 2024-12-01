<?php

namespace App\Http\Controllers;

use App\Helpers\ImageValidator;
use App\Helpers\ResponseHelper;
use App\Models\LeftPicture;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LeftPictureController extends Controller
{

    public function index()
    {
        $leftPicture = LeftPicture::first();
        return ResponseHelper::success($leftPicture, 'leftPicture data retrive successfully');
    }

    public function storeUpdate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'designation' => 'required|string',
            'image' => 'required|string',
        ]);

        if ($validator->fails()) {
            return ResponseHelper::unprocessableEntity('Validation Error', $validator->errors());
        }

        $leftPictureCheck = LeftPicture::first();

        if ($leftPictureCheck) {
            if ($request->has('image') && $request->image) {
                if ($leftPictureCheck->image) {
                    ImageValidator::deleteImage('backend/images/leftpicture/' . $leftPictureCheck->image);
                }
                $saveImage = ImageValidator::saveBase64Image($request->image, 'backend/images/leftpicture/');
                if (!$saveImage['status']) {
                    return ResponseHelper::unprocessableEntity($saveImage['message']);
                }
                $leftPictureCheck->image = $saveImage['image_name'];
            }
            $leftPictureCheck->name = $request->name;
            $leftPictureCheck->designation = $request->designation;
            $leftPictureCheck->academy_id = 1;
            $leftPictureCheck->save();
            return ResponseHelper::success($leftPictureCheck, 'Leftpictrue updated successfully!');
        } else {
            if ($request->has('image') && $request->image) {
                $image = $request->image;
                $saveImage = ImageValidator::saveBase64Image($image, 'backend/images/leftpicture/');

                if (!$saveImage['status']) {
                    return response()->json(['message' => $saveImage['message']], 422);
                }

                $imagePath = $saveImage['image_name'];
            }
            $leftpicture = LeftPicture::create([
                'name' => $request->name,
                'designation' => $request->designation,
                'image' => $imagePath,
                'academy_id' => 1
            ]);

            return ResponseHelper::success($leftpicture, 'Leftpictrue details created successfully!');
        }
    }









    

    public function find($id)
    {

        $leftPicture = LeftPicture::where('academy_id', $id)->first();
        return response()->json($leftPicture);
    }

    public function update(Request $request)
    {
        $leftPicture = LeftPicture::where('academy_id', $request->academy_id)->first();
        if ($request->has('image') && $request->image) {
            if ($leftPicture->image) {
                ImageValidator::deleteImage('backend/images/leftpicture/' . $leftPicture->image);
            }
            $saveImage = ImageValidator::saveBase64Image($request->image, 'backend/images/leftpicture/');
            if (!$saveImage['status']) {
                return ResponseHelper::unprocessableEntity($saveImage['message']);
            }
            $leftPicture->image = $saveImage['image_name'];
        }
        $leftPicture->name = $request->name;
        $leftPicture->designation = $request->designation;
        $leftPicture->academy_id = 1;
        $leftPicture->save();
        return ResponseHelper::success($leftPicture, 'Leftpictrue updated successfully!');
    }
}
