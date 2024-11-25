<?php

namespace App\Http\Controllers;

use App\Helpers\ImageValidator;
use App\Helpers\ResponseHelper;
use App\Models\Campus;
use Illuminate\Http\Request;

class CampusController extends Controller
{
    public function index()
    {
        $campusPicture = Campus::first();
        return ResponseHelper::success($campusPicture, "Campus Picture data retrieved successfully.");
    }

    public function storeUpdate(Request $request)
    {
        $request->validate([
            'picture1' => 'required|string',
            'picture2' => 'required|string',
        ]);

        $campusPicture = Campus::first();

        if ($campusPicture) {
            $updatedImages = [];
            $requestData = $request->all();
            foreach ($requestData as $key => $base64Image) {
                if (str_starts_with($key, 'picture') && $base64Image) {
                    if ($campusPicture->$key) {
                        ImageValidator::deleteImage("backend/images/campus/" . $campusPicture->$key);
                    }
                    $savedImage = ImageValidator::saveBase64Image($base64Image, 'backend/images/campus/');
                    if (!$savedImage['status']) {
                        foreach ($updatedImages as $image) {
                            ImageValidator::deleteImage($image['image_path']);
                        }
                        return response()->json(['message' => $savedImage['message']], 422);
                    }
                    $campusPicture->$key = $savedImage['image_name'];
                    $updatedImages[] = $savedImage;
                }
            }
            $campusPicture->save();
            return response()->json([
                'message' => 'Campus Images updated and data saved successfully!',
                'campus' => $campusPicture
            ], 200);
        } else {
            $savePicture1 = ImageValidator::saveBase64Image($request->picture1, 'backend/images/campus/');
            if (!$savePicture1['status']) {
                return response()->json(['message' => $savePicture1['message']], 422);
            }

            // Validate and save picture2
            $savePicture2 = ImageValidator::saveBase64Image($request->picture2, 'backend/images/campus/');
            if (!$savePicture2['status']) {
                // Clean up previously saved image if second save fails
                ImageValidator::deleteImage($savePicture1['image_path']);
                return response()->json(['message' => $savePicture2['message']], 422);
            }

            // Store data in the database
            $campus = Campus::create([
                'picture1' => $savePicture1['image_name'],
                'picture2' => $savePicture2['image_name'],
            ]);

            return response()->json([
                'message' => 'Campus Images uploaded and data saved successfully!',
                'campus' => $campus
            ], 201);
        }
    }

    public function find($id)
    {
        $campusPicture = Campus::first();
        return response()->json($campusPicture);
    }

    public function findto()
    {
        $campusPicture = Campus::first();

        if (!$campusPicture) {
            return response()->json(['message' => 'No campus pictures found'], 404);
        }

        // Extract the pictures into an array
        $pictures = [];
        foreach ($campusPicture->toArray() as $key => $value) {
            if (str_starts_with($key, 'picture') && $value) {
                $pictures[] = $value;
            }
        }

        return response()->json($pictures);
    }

    public function update(Request $request)
    {
        // return response()->json($request->all());
        // $campusPicture = Campus::findOrFail($request->campusPicture_id);

        // if ($request->picture1) {
        //     if ($campusPicture->picture1) {
        //         ImageValidator::deleteImage("backend/images/campus/" . $campusPicture->picture1);
        //     }
        //     $savePicture1 = ImageValidator::saveBase64Image($request->picture1, 'backend/images/campus/');
        //     if (!$savePicture1['status']) {
        //         return response()->json(['message' => $savePicture1['message']], 422);
        //     }
        //     $campusPicture->picture1 = $savePicture1['image_name'];
        // }
        // if ($request->picture2) {
        //     if ($campusPicture->picture2) {
        //         ImageValidator::deleteImage("backend/images/campus/" . $campusPicture->picture2);
        //     }
        //     $savePicture2 = ImageValidator::saveBase64Image($request->picture2, 'backend/images/campus/');
        //     if (!$savePicture2['status']) {
        //         if ($request->picture1) {
        //             ImageValidator::deleteImage("backend/images/campus/" . $savePicture1['image_name']);
        //         }
        //         return response()->json(['message' => $savePicture2['message']], 422);
        //     }
        //     $campusPicture->picture2 = $savePicture2['image_name'];
        // }
        // $campusPicture->save();

        // return response()->json([
        //     'message' => 'Images updated and data saved successfully!',
        //     'campus' => $campusPicture
        // ], 200);
        $campusPicture = Campus::findOrFail($request->campusPicture_id);
        $updatedImages = [];
        $requestData = $request->except('campusPicture_id');
        foreach ($requestData as $key => $base64Image) {
            if (str_starts_with($key, 'picture') && $base64Image) {
                if ($campusPicture->$key) {
                    ImageValidator::deleteImage("backend/images/campus/" . $campusPicture->$key);
                }
                $savedImage = ImageValidator::saveBase64Image($base64Image, 'backend/images/campus/');
                if (!$savedImage['status']) {
                    foreach ($updatedImages as $image) {
                        ImageValidator::deleteImage($image['image_path']);
                    }
                    return response()->json(['message' => $savedImage['message']], 422);
                }
                $campusPicture->$key = $savedImage['image_name'];
                $updatedImages[] = $savedImage;
            }
        }
        $campusPicture->save();
        return response()->json([
            'message' => 'Campus Images updated and data saved successfully!',
            'campus' => $campusPicture
        ], 200);
    }
}
