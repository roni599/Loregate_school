<?php

namespace App\Http\Controllers;

use App\Helpers\ImageValidator;
use App\Helpers\ResponseHelper;
use App\Models\PrimePresedent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PrimePresedentController extends Controller
{
    public function index()
    {
        $primepresedent = PrimePresedent::first();
        return ResponseHelper::success($primepresedent, "Prime Presedent Data retrive successfully");
    }
    public function storeUpdate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'prime_minister_name' => 'required|string|max:255',
            'prime_minister_designation' => 'required|string|max:255',
            'prime_minister_image' => 'nullable|string',
            'president_name' => 'required|string|max:255',
            'president_designation' => 'required|string|max:255',
            'president_image' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return ResponseHelper::unprocessableEntity('Validation Error', $validator->errors());
        }

        $primepresedent = PrimePresedent::first();

        if ($primepresedent) {
            $updatedImages = [];
            $requestData = $request->all();
            foreach ($requestData as $key => $value) {
                if (str_starts_with($key, 'prime_minister_image') || str_starts_with($key, 'president_image')) {
                    if ($value) {
                        if ($primepresedent->$key) {
                            ImageValidator::deleteImage("backend/images/primepresedent/" . $primepresedent->$key);
                        }
                        $savedImage = ImageValidator::saveBase64Image($value, 'backend/images/primepresedent/');
                        if (!$savedImage['status']) {
                            foreach ($updatedImages as $image) {
                                ImageValidator::deleteImage($image['image_path']);
                            }
                            return response()->json(['message' => $savedImage['message']], 422);
                        }
                        $primepresedent->$key = $savedImage['image_name'];
                        $updatedImages[] = $savedImage;
                    }
                } else {
                    $primepresedent->$key = $value;
                }
            }
            $primepresedent->save();
            return ResponseHelper::success($primepresedent, "Primepresedent updated successfully");
        } else {
            $savePicture1 = ImageValidator::saveBase64Image($request->prime_minister_image, 'backend/images/primepresedent/');
            if (!$savePicture1['status']) {
                return response()->json(['message' => $savePicture1['message']], 422);
            }

            $savePicture2 = ImageValidator::saveBase64Image($request->president_image, 'backend/images/primepresedent/');
            if (!$savePicture2['status']) {
                ImageValidator::deleteImage($savePicture1['image_path']);
                return response()->json(['message' => $savePicture2['message']], 422);
            }

            PrimePresedent::create([
                'prime_minister_name' => $request->prime_minister_name,
                'prime_minister_designation' => $request->prime_minister_designation,
                'president_name' => $request->president_name,
                'president_designation' => $request->president_designation,
                'prime_minister_image' => $savePicture1['image_name'],
                'president_image' => $savePicture2['image_name'],
                'academy_id' => 1
            ]);

            return response()->json('Prime Minister and Presedient details saved successfully');
        }
    }
















    
    public function find($id)
    {
        $primepresedent = PrimePresedent::find($id);
        return ResponseHelper::success($primepresedent, "Prime Presedent Data retrive successfully");
    }

    public function update(Request $request)
    {
        $primepresedent = PrimePresedent::find($request->academy_id);
        if (!$primepresedent) {
            return ResponseHelper::notFound('Prime President not found.');
        }

        $updatedImages = [];
        $requestData = $request->all();

        foreach ($requestData as $key => $value) {
            if (str_starts_with($key, 'prime_minister_image') || str_starts_with($key, 'president_image')) {
                if ($value) {
                    if ($primepresedent->$key) {
                        ImageValidator::deleteImage("backend/images/primepresedent/" . $primepresedent->$key);
                    }
                    $savedImage = ImageValidator::saveBase64Image($value, 'backend/images/primepresedent/');
                    if (!$savedImage['status']) {
                        foreach ($updatedImages as $image) {
                            ImageValidator::deleteImage($image['image_path']);
                        }
                        return response()->json(['message' => $savedImage['message']], 422);
                    }
                    $primepresedent->$key = $savedImage['image_name'];
                    $updatedImages[] = $savedImage;
                }
            } else {
                $primepresedent->$key = $value;
            }
        }
        $primepresedent->save();
        return ResponseHelper::success($primepresedent, "Primepresedent updated successfully");
    }
}
