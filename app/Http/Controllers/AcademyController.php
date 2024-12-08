<?php

namespace App\Http\Controllers;

use App\Helpers\ImageValidator;
use App\Helpers\ResponseHelper;
use App\Models\Academy;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AcademyController extends Controller
{
    public function index()
    {
        try {
            $academy = Academy::first();

            if (!$academy) {
                return ResponseHelper::notFound('No academy data found');
            }
            return ResponseHelper::success($academy, 'Academy data retrieved successfully');
        } catch (\Exception $e) {
            return ResponseHelper::internalServerError('Failed to retrieve academy data', ['exception' => $e->getMessage()]);
        }
    }

    public function storeUpdate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'academy_name' => 'required|string|max:100',
            'academy_address' => 'required|string|max:100',
            'academy_mobile_number' => 'required|string|max:15',
            // 'facebook_link' => 'nullable|url|max:255',
            // 'youtube_link' => 'nullable|url|max:255',
            'academy_logo' => 'nullable|string',
        ]);
        
        if ($validator->fails()) {
            return ResponseHelper::unprocessableEntity('Validation Error', $validator->errors());
        }

        $academy_heading = Academy::first();

        if ($academy_heading) {
            if (!$academy_heading) {
                return ResponseHelper::unprocessableEntity('Academy not found');
            }
            if ($request->has('academy_logo') && $request->academy_logo) {
                if ($academy_heading->academy_logo) {
                    ImageValidator::deleteImage('backend/images/academy/' . $academy_heading->academy_logo);
                }
                $saveImage = ImageValidator::saveBase64Image($request->academy_logo, 'backend/images/academy/');
                if (!$saveImage['status']) {
                    return ResponseHelper::unprocessableEntity($saveImage['message']);
                }
                $academy_heading->academy_logo = $saveImage['image_name'];
            }
            $academy_heading->academy_name = $request->academy_name;
            $academy_heading->academy_address = $request->academy_address;
            $academy_heading->academy_mobile_number = $request->academy_mobile_number;
            // $academy_heading->facebook_link = $request->academy_facebook_link;
            // $academy_heading->youtube_link = $request->academy_youtube_link;
            $academy_heading->save();
            return ResponseHelper::success($academy_heading, 'Academy Header updated successfully!');
        } else {
            $academy = new Academy();

            if ($request->has('academy_logo') && $request->academy_logo) {
                $saveImage = ImageValidator::saveBase64Image($request->academy_logo, 'backend/images/academy/');

                if (!$saveImage['status']) {
                    return ResponseHelper::unprocessableEntity($saveImage['message']);
                }

                $academy->academy_logo = $saveImage['image_name'];
            }
            $academy->academy_name = $request->academy_name;
            $academy->academy_address = $request->academy_address;
            $academy->academy_mobile_number = $request->academy_mobile_number;
            // $academy->facebook_link = $request->academy_facebook_link;
            // $academy->youtube_link = $request->academy_youtube_link;
            $academy->save();
            return ResponseHelper::success($academy, 'Academy Header saved successfully!');
        }
    }

    public function find($id)
    {
        try {
            $header = Academy::findOrFail($id);
            return ResponseHelper::success($header, 'Academy data retrieved successfully');
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return ResponseHelper::notFound('No academy data found');
        } catch (\Exception $e) {
            return ResponseHelper::internalServerError('Failed to retrieve academy data', ['exception' => $e->getMessage()]);
        }
    }

    public function allusers()
    {
        $allusers = User::all();
        return response()->json($allusers);
    }

    public function userSelfUpdate(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'image' => 'nullable|string',
        ]);

        $user = User::find($request->id);
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }
        if ($request->has('image') && strpos($request->image, 'data:image/') === 0) {
            $imagePath = public_path('backend/images/users/' . $user->image);
            if ($user->image && file_exists($imagePath)) {
                unlink($imagePath);
            }

            $position = strpos($request->image, ';');
            $sub = substr($request->image, 0, $position);
            $ext = explode('/', $sub)[1];
            $imageName = rand(1, 1000) . '_' . $request->name . '.' . $ext;
            $image = str_replace('data:image/' . $ext . ';base64,', '', $request->image);
            $image = str_replace(' ', '+', $image);

            $imagePath = public_path('backend/images/users/' . $imageName);
            if (!File::isDirectory(public_path('backend/images/users'))) {
                File::makeDirectory(public_path('backend/images/users'), 0755, true, true);
            }

            File::put($imagePath, base64_decode($image));
            $user->image = $imageName;
        }
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);
        return response()->json(['message' => 'User updated successfully']);
    }
    public function userSelfUpdatePassword(Request $request)
    {
        $request->validate([
            'password' => 'required|string|min:8|confirmed',
        ]);
        $user = User::find($request->id);
        $user->password = Hash::make($request->password);
        $user->save();

        return response()->json(['message' => 'Password updated successfully']);
    }
}
