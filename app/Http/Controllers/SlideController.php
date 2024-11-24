<?php

namespace App\Http\Controllers;

use App\Helpers\ImageValidator;
use App\Helpers\ResponseHelper;
use App\Models\Slide;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SlideController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'images' => 'required|array|min:1',
            'images.*' => 'required|string',
        ]);
        if ($validator->fails()) {
            return ResponseHelper::unprocessableEntity('Image must not be empty', $validator->errors());
        }
        $slide = new Slide();
        if ($request->has('images') && is_array($request->images)) {
            $pictures = [];
            foreach ($request->images as $image) {
                $saveImage = ImageValidator::saveBase64Image($image, 'backend/images/slidepicture/');
                if ($saveImage['status']) {
                    $pictures[] = $saveImage['image_name'];
                } else {
                    return response()->json(['error' => $saveImage['message']], 422);
                }
            }
            $slide->pictures = $pictures;
        }
        $slide->save();
        return ResponseHelper::success($slide, 'Sliding Picture saved successfully!');
    }

    public function find($id)
    {
        $slide = Slide::find($id);
        return response()->json($slide);
        if (!$slide) {
            return response()->json(['error' => 'Slide not found'], 404);
        }
        if ($slide->pictures) {
            return response()->json([
                'pictures' => $slide,
            ]);
        }
    }

    public function delete(Request $request)
    {

        $imageToDelete = $request->input('image');
        $academyId = $request->input('academy_id');
        $academy = Slide::find($academyId);
        if (!$academy) {
            return response()->json(['success' => false, 'message' => 'Academy not found']);
        }
        $pictures = $academy->pictures;
        if (($key = array_search($imageToDelete, $pictures)) !== false) {
            unset($pictures[$key]);
            $pictures = array_values($pictures);
            $academy->pictures = $pictures;
            $academy->save();
            $imagePath = "backend/images/slidepicture/{$imageToDelete}";
            if (ImageValidator::deleteImage($imagePath)) {
                return response()->json(['success' => true, 'message' => 'Image deleted successfully']);
            } else {
                return response()->json(['success' => false, 'message' => 'Failed to delete image from server']);
            }
        }
        return ResponseHelper::success($academy, 'Sliding Picture saved successfully!');
    }
}
