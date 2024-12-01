<?php

namespace App\Http\Controllers;

use App\Helpers\ImageValidator;
use App\Helpers\ResponseHelper;
use App\Models\TeacherGallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TeacherGalleryController extends Controller
{
    public function index(){
        $teacherGallery=TeacherGallery::all();
        return ResponseHelper::success($teacherGallery, 'Teacher Gallery data retrive successfully');
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
            $saveImage = ImageValidator::saveBase64Image($image, 'backend/images/teachergallery/');

            if (!$saveImage['status']) {
                return response()->json(['message' => $saveImage['message']], 422);
            }

            $imagePath = $saveImage['image_name'];
        }
        $teacherGallery = TeacherGallery::create([
            'name' => $request->name,
            'designation' => $request->designation,
            'mobile' => $request->mobile,
            'email' => $request->email,
            'religion' => $request->religion,
            'image' => $imagePath,
            'academy_id' => 1
        ]);

        return response()->json(['message' => 'Teacher Gallery data stored successfully', 'data' => $teacherGallery], 201);
    }
    public function find($id)
    {
        $teacherGalleryData = TeacherGallery::where('academy_id', $id)->get();
        return ResponseHelper::success($teacherGalleryData, 'Teacher GalleryData Retrive successfully');
    }
}
