<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseHelper;
use App\Models\Academy;
use App\Models\AcademyHistory;
use App\Models\BoardNews;
use App\Models\BoardNotice;
use App\Models\Campus;
use App\Models\EducationBoard;
use App\Models\Heading;
use App\Models\LeftPicture;
use App\Models\Magazine;
use App\Models\ManagingCommunity;
use App\Models\MediaLink;
use App\Models\PrimePresedent;
use App\Models\RightPicture;
use App\Models\Slidevalue;
use App\Models\StaffData;
use App\Models\TeacherGallery;
use App\Models\Websitelink;
use App\Models\WinnerGallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MediaLinkController extends Controller
{
    public function all()
    {
        $academy = Academy::first();
        $slidepicture = Slidevalue::first();
        $academy = Academy::first();
        $leftPicture = LeftPicture::first();
        $rightPicture = RightPicture::first();
        $staffDataId = StaffData::first();
        $academyHistory = AcademyHistory::first();
        $educationBoard = EducationBoard::first();
        $primepresedent = PrimePresedent::first();
        $managingCummunity = ManagingCommunity::all();
        $teacherGallery = TeacherGallery::all();
        $boardNotice = BoardNotice::all();
        $websitelink = Websitelink::all();
        $boardNews = BoardNews::all();
        $winnergallery = WinnerGallery::all();
        $magazine = Magazine::all();
        $campusPicture = Campus::first();
        $heading = Heading::first();
        $data = [
            'heading' => $heading,
            'slidepicture' => $slidepicture,
            'academy' => $academy,
            'leftPicture' => $leftPicture,
            'rightPicture' => $rightPicture,
            'staffDataId' => $staffDataId,
            'academyHistory' => $academyHistory,
            'educationBoard' => $educationBoard,
            'primepresedent' => $primepresedent,
            'managingCummunity' => $managingCummunity,
            'teacherGallery' => $teacherGallery,
            'boardNotice' => $boardNotice,
            'academy' => $academy,
            'websitelink' => $websitelink,
            'boardNews' => $boardNews,
            'winnergallery' => $winnergallery,
            'magazine' => $magazine,
            'campusPicture' => $campusPicture,
        ];
        return ResponseHelper::success($data, 'HomePage data retrieved successfully');
    }
    public function index()
    {
        $links = MediaLink::first();
        return response()->json($links);
    }
    public function storeUpdate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'location' => 'nullable|string|max:255',
            'facebook_link' => 'nullable|url|max:255',
            'youtube_link' => 'nullable|url|max:255',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        $mediaLink = MediaLink::first();

        if ($mediaLink) {
            $links = $mediaLink->links ?? [];
            $links['location_link'] = $request->input('location', null);
            $links['facebook_link'] = $request->input('facebook_link', null);
            $links['youtube_link'] = $request->input('youtube_link', null);

            $mediaLink->links = $links;
            $mediaLink->save();

            return response()->json([
                'message' => 'Media link updated successfully',
                'data' => $mediaLink,
            ]);
        } else {
            $mediaLink = new MediaLink();
            $mediaLink->links = [
                'location_link' => $request['location'],
                'facebook_link' => $request['facebook_link'],
                'youtube_link' => $request['youtube_link'],
            ];
            $mediaLink->save();

            return response()->json(['message' => 'Media links saved successfully!']);
        }
    }
    public function getLinks($id)
    {
        $links = MediaLink::find($id);
        return response()->json($links);
    }




























    public function update(Request $request)
    {
        // $mediaLink = MediaLink::find(1);

        // if (!$mediaLink) {
        //     return response()->json(['error' => 'Media link not found'], 404);
        // }
        // $validator = Validator::make($request->all(), [
        //     'location_link' => 'nullable|string|max:255',
        //     'facebook_link' => 'nullable|url|max:255',
        //     'youtube_link' => 'nullable|url|max:255',
        // ]);

        // if ($validator->fails()) {
        //     return response()->json(['errors' => $validator->errors()], 422);
        // }
        // $links = $mediaLink->links ?? [];
        // if ($request->filled('location_link')) {
        //     $links['location_link'] = $request->input('location_link');
        // }
        // if ($request->filled('facebook_link')) {
        //     $links['facebook_link'] = $request->input('facebook_link');
        // }
        // if ($request->filled('youtube_link')) {
        //     $links['youtube_link'] = $request->input('youtube_link');
        // }
        // $mediaLink->links = $links;
        // $mediaLink->save();

        // return response()->json([
        //     'message' => 'Media link updated successfully',
        //     'data' => $mediaLink,
        // ]);

        $mediaLink = MediaLink::find(1);

        if (!$mediaLink) {
            return response()->json(['error' => 'Media link not found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'location_link' => 'nullable|string|max:255',
            'facebook_link' => 'nullable|url|max:255',
            'youtube_link' => 'nullable|url|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $links = $mediaLink->links ?? [];

        // Set each field to the provided input or null if not present
        $links['location_link'] = $request->input('location_link', null);
        $links['facebook_link'] = $request->input('facebook_link', null);
        $links['youtube_link'] = $request->input('youtube_link', null);

        $mediaLink->links = $links;
        $mediaLink->save();

        return response()->json([
            'message' => 'Media link updated successfully',
            'data' => $mediaLink,
        ]);
    }
}
