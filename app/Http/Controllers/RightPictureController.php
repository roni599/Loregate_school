<?php

namespace App\Http\Controllers;

use App\Helpers\ImageValidator;
use App\Helpers\ResponseHelper;
use App\Models\RightPicture;
use Illuminate\Http\Request;

class RightPictureController extends Controller
{
    public function index()
    {
        $rightpicture = RightPicture::first();
        return ResponseHelper::success($rightpicture, 'RightPicture retrive data successfully');
    }
    public function storeUpdate(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'designation' => 'required|string|max:255',
            'image' => 'nullable|string',
        ]);

        $rightpicture = RightPicture::first();
        
        if ($rightpicture) {
            if ($request->has('image') && $request->image) {
                if ($rightpicture->image) {
                    ImageValidator::deleteImage('backend/images/rightpicture/' . $rightpicture->image);
                }
                $saveImage = ImageValidator::saveBase64Image($request->image, 'backend/images/rightpicture/');
                if (!$saveImage['status']) {
                    return ResponseHelper::unprocessableEntity($saveImage['message']);
                }
                $rightpicture->image = $saveImage['image_name'];
            }
            $rightpicture->name = $request->name;
            $rightpicture->designation = $request->designation;
            $rightpicture->academy_id = 1;
            $rightpicture->save();
            return ResponseHelper::success($rightpicture, 'Rightpicture updated successfully!');
        } else {

            if ($request->has('image') && $request->image) {
                $image = $request->image;
                $saveImage = ImageValidator::saveBase64Image($image, 'backend/images/rightpicture/');

                if (!$saveImage['status']) {
                    return response()->json(['message' => $saveImage['message']], 422);
                }

                $imagePath = $saveImage['image_name'];
            }

            RightPicture::create([
                'name' => $request->name,
                'designation' => $request->designation,
                'image' => $imagePath,
                'academy_id' => 1
            ]);

            return ResponseHelper::success($rightpicture, 'Rightpicture updated successfully!');
        }
    }

    public function find($id)
    {

        $rightpicture = RightPicture::where('academy_id', $id)->first();
        return response()->json($rightpicture);
    }

    public function update(Request $request)
    {
        $rightpicture = RightPicture::where('academy_id', $request->academy_id)->first();
        if ($request->has('image') && $request->image) {
            if ($rightpicture->image) {
                ImageValidator::deleteImage('backend/images/rightpicture/' . $rightpicture->image);
            }
            $saveImage = ImageValidator::saveBase64Image($request->image, 'backend/images/rightpicture/');
            if (!$saveImage['status']) {
                return ResponseHelper::unprocessableEntity($saveImage['message']);
            }
            $rightpicture->image = $saveImage['image_name'];
        }
        $rightpicture->name = $request->name;
        $rightpicture->designation = $request->designation;
        $rightpicture->academy_id = 1;
        $rightpicture->save();
        return ResponseHelper::success($rightpicture, 'RightPicture updated successfully!');
    }
}
