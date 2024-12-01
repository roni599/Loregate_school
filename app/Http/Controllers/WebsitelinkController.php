<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseHelper;
use App\Models\Websitelink;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class WebsitelinkController extends Controller
{
    public function index(){
        $websitelink=Websitelink::all();
        return ResponseHelper::success($websitelink,'Website Link Data retrive successfully');
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'link' => 'required|url',
        ]);
        if ($validator->fails()) {
            return ResponseHelper::unprocessableEntity('Validation Error', $validator->errors());
        }
        $validated = $validator->validated();
        $websitelink = Websitelink::create([
            'title' => $validated['title'],
            'link' => $validated['link'],
            'academy_id' => 1,
        ]);
        return response()->json([
            'message' => 'Website link saved successfully.',
            'data' => $websitelink,
        ], 201);
    }

    public function find($id){
        $websitelink=Websitelink::where('academy_id',$id)->get();
        return ResponseHelper::success($websitelink,"WebsiteLink data retrive successfully done");
    }
}
