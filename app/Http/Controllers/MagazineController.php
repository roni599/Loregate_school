<?php

namespace App\Http\Controllers;

use App\Helpers\ImageValidator;
use App\Helpers\ResponseHelper;
use App\Models\Magazine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MagazineController extends Controller
{

    public function index()
    {
        $magazine = Magazine::all();
        return ResponseHelper::success($magazine, "Magazine Data retrive successfully");
    }

    public function educationdata()
    {
        $education = Magazine::where('subject', 'education')->get();
        return ResponseHelper::success($education, "EducationData retrive successfully");
    }
    public function healthdata()
    {
        $health = Magazine::where('subject', 'health')->get();
        return ResponseHelper::success($health, "HealthData retrive successfully");
    }
    public function religiondata()
    {
        $religion = Magazine::where('subject', 'religion')->get();
        return ResponseHelper::success($religion, "ReligionData retrive successfully");
    }
    public function newsdata()
    {
        $news = Magazine::where('subject', 'news')->get();
        return ResponseHelper::success($news, "NewsData retrive successfully");
    }
    public function poemdata()
    {
        $poem = Magazine::where('subject', 'poem')->get();
        return ResponseHelper::success($poem, "PoemData retrive successfully");
    }
    public function jokesdata()
    {
        $jokes = Magazine::where('subject', 'jokes')->get();
        return ResponseHelper::success($jokes, "JokesData retrive successfully");
    }

    public function storydata()
    {
        $story = Magazine::where('subject', 'story')->get();
        return ResponseHelper::success($story, "StoryData retrive successfully");
    }
    public function magicdata()
    {
        $jokes = Magazine::where('subject', 'magic')->get();
        return ResponseHelper::success($jokes, "MagicData retrive successfully");
    }

    public function find($id)
    {
        $magazineListview = Magazine::findOrFail($id);
        return ResponseHelper::success($magazineListview, "Magazinedata retrive successfully");
    }

    public function store(Request $request)
    {

        // Validate the incoming data
        $validator = Validator::make($request->all(), [
            'subject' => 'required|string|max:255',
            'heading' => 'required|string|max:255',
            'writer' => 'required|string|max:255',
            'data_sources' => 'required|string|max:255',
            'description' => 'required|string',
            'date' => 'required|date',
            'image' => 'required|string'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation Error',
                'errors' => $validator->errors()
            ], 422);
        }
        if ($request->has('image') && $request->image) {
            $image = $request->image;
            $saveImage = ImageValidator::saveBase64Image($image, 'backend/images/magazine/');

            if (!$saveImage['status']) {
                return response()->json(['message' => $saveImage['message']], 422);
            }
            $imagePath = $saveImage['image_name'];
        }
        // Store the data in the database
        $magazine = Magazine::create([
            'subject' => $request->input('subject'),
            'heading' => $request->input('heading'),
            'writer' => $request->input('writer'),
            'data_sources' => $request->input('data_sources'),
            'description' => $request->input('description'),
            'date' => $request->input('date'),
            'image' => $imagePath,
            'academy_id' => 1
        ]);

        return response()->json([
            'message' => 'Magazine created successfully!',
            'data' => $magazine
        ]);
    }
}
