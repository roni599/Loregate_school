<?php

namespace App\Http\Controllers;

use App\Helpers\ImageValidator;
use App\Helpers\ResponseHelper;
use App\Models\ManagingCommunity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ManagingCommunityController extends Controller
{

    public function index(){
        $managingCummunity=ManagingCommunity::all();
        return ResponseHelper::success($managingCummunity,'ManagingCommunity data retrive successfully');
    }

    
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'designation' => 'required|string',
            'mobile' => 'required|digits:11',
            'email' => 'required|email',
            'religion' => 'required|string',
            'image' => 'nullable|string',
        ]);
       
        if ($validator->fails()) {
            return ResponseHelper::unprocessableEntity('Validation Error', $validator->errors());
        }
        if ($request->has('image') && $request->image) {
            $image = $request->image;
            $saveImage = ImageValidator::saveBase64Image($image, 'backend/images/managingcummunity/');

            if (!$saveImage['status']) {
                return response()->json(['message' => $saveImage['message']], 422);
            }
            $imagePath = $saveImage['image_name'];
        }
        $managingCummunity = ManagingCommunity::create([
            'name' => $request->name,
            'designation' => $request->designation,
            'mobile' => $request->mobile,
            'email' => $request->email,
            'religion' => $request->religion,
            'image' => $imagePath,
            'academy_id' => 1
        ]);

        return response()->json(['message' => 'Managing Cummunity data stored successfully', 'data' => $managingCummunity], 201);
    }
    public function find($id)
    {
        $managingCummunityData = ManagingCommunity::where('academy_id', $id)->get();
        return ResponseHelper::success($managingCummunityData, 'Teacher GalleryData Retrive successfully');
    }
}
