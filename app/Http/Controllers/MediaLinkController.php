<?php

namespace App\Http\Controllers;

use App\Models\MediaLink;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MediaLinkController extends Controller
{
    public function index()
    {
        $links = MediaLink::first();
        return response()->json($links);
    }
    public function storeUpdate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'location_link' => 'nullable|string|max:255',
            'facebook_link' => 'nullable|url|max:255',
            'youtube_link' => 'nullable|url|max:255',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        $mediaLink = MediaLink::first();

        if ($mediaLink) {
            $links = $mediaLink->links ?? [];
            $links['location_link'] = $request->input('location_link', null);
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
                'location_link' => $request['location_link'],
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
