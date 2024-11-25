<?php

namespace App\Http\Controllers;

use App\Helpers\ImageValidator;
use App\Helpers\ResponseHelper;
use App\Models\Slidevalue;
use Illuminate\Http\Request;

use function Laravel\Prompts\alert;

class SlidevalueController extends Controller
{
    public function index()
    {
        $slidepicture = Slidevalue::first();
        // return response()->json($slidepicture);
        return ResponseHelper::success($slidepicture, "SlidePicture Data retrive successfully");
    }
    public function store(Request $request)
    {
        if (!$request->has('images') || !is_array($request->images)) {
            return response()->json([
                'status' => false,
                'message' => 'Invalid or missing images.',
            ], 400);
        }

        $data = [];
        foreach ($request->images as $index => $image) {
            if ($image) {
                $saveImage = ImageValidator::saveBase64Image($image, 'backend/images/slidevalue/');
                if (!$saveImage['status']) {
                    return response()->json([
                        'status' => false,
                        'message' => $saveImage['message'],
                    ], 400);
                }
                $data["image" . ($index + 1)] = $saveImage['image_name'];
            }
        }
        Slidevalue::create($data);

        return response()->json([
            'status' => true,
            'message' => 'Images uploaded successfully!',
        ]);
    }

    public function find($id)
    {
        $slidepicture = Slidevalue::where('academy_id', $id)->first();
        return response()->json($slidepicture);
    }

    public function deleteImage(Request $request)
    {
        $validated = $request->validate([
            'academy_id' => 'required|integer',
            'imageKey' => 'required|string',
        ]);

        $academy = Slidevalue::where('academy_id', $validated['academy_id'])->first();
        if (!$academy) {
            return response()->json(['success' => false, 'message' => 'Academy not found'], 404);
        }
        $imageKey = $validated['imageKey'];
        if (in_array($imageKey, ['image1', 'image2', 'image3'])) {
            $imagePath = $academy->$imageKey;
            if ($imagePath) {
                $deleted = ImageValidator::deleteImage('backend/images/slidevalue/' . $imagePath);

                if (!$deleted) {
                    return response()->json(['success' => false, 'message' => 'Failed to delete image'], 500);
                }
            }
            $academy->$imageKey = null;
            $academy->save();

            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false, 'message' => 'Invalid image key'], 400);
    }

    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'academy_id' => 'required',
            'images' => 'required|array|min:1',
            'images.*' => 'string',
        ]);
        $academy = Slidevalue::where('academy_id', $request->academy_id)->first();

        if (!$academy) {
            return response()->json(['message' => 'Academy not found'], 404);
        }
        $updatedImages = [];
        foreach ($validatedData['images'] as $index => $base64Image) {
            $savedImage = ImageValidator::saveBase64Image($base64Image, 'backend/images/slidevalue/');

            if (!$savedImage['status']) {
                foreach ($updatedImages as $image) {
                    ImageValidator::deleteImage('backend/images/slidevalue/' . $image['image_name']);
                }
                return response()->json(['message' => $savedImage['message']], 422);
            }
            $updatedImages[] = $savedImage;
            $imageKey = "image" . ($index + 1);
            if ($academy->$imageKey) {
                ImageValidator::deleteImage('backend/images/slidevalue/' . $academy->$imageKey);
            }
            $academy->$imageKey = $savedImage['image_name'];
        }
        $academy->save();

        return response()->json(['message' => 'Images updated successfully'], 200);
    }
}
