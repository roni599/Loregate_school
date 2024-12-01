<?php

namespace App\Http\Controllers;

use App\Helpers\ImageValidator;
use App\Helpers\ResponseHelper;
use App\Models\WinnerGallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class WinnerGalleryController extends Controller
{

    public function index(){
        $winnergallery=WinnerGallery::all();
        return ResponseHelper::success($winnergallery,"Winner Gallery data retrive successfully");
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'event_name' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'class' => 'required|string|max:255',
            'roll_or_uid' => 'required|string|max:255',
            'winning_place' => 'required|string|max:255',
            'price' => 'required|numeric',
            'image' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return ResponseHelper::unprocessableEntity('Validation Error', $validator->errors());
        }

        $imagePath = null;
        if ($request->has('image') && $request->image) {
            $image = $request->image;
            $saveImage = ImageValidator::saveBase64Image($image, 'backend/images/winnergallery/');

            if (!$saveImage['status']) {
                return response()->json(['message' => $saveImage['message']], 422);
            }

            $imagePath = $saveImage['image_name'];
        }

        $event = new WinnerGallery();
        $event->event_name = $request->event_name;
        $event->name = $request->name;
        $event->class = $request->class;
        $event->roll_or_uid = $request->roll_or_uid;
        $event->winning_place = $request->winning_place;
        $event->price = $request->price;
        $event->image = $imagePath;
        $event->academy_id = 1;
        $event->save();

        return response()->json(['message' => 'Winnergallery created successfully!']);
    }
}
