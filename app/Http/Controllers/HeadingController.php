<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseHelper;
use App\Models\Heading;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class HeadingController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'headings' => 'required|array|min:1',
            'headings.*' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return ResponseHelper::unprocessableEntity('Validation Error', $validator->errors());
        }
        $validated = $validator->validated();
        $heading = new Heading();
        $heading->headings = $validated['headings'];
        $heading->save();
        return ResponseHelper::success($heading, 'Academy Header saved successfully!');
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'headings' => 'required|array|min:1',
            'headings.*' => 'required|string|max:255',
        ]);
        if ($validator->fails()) {
            return ResponseHelper::unprocessableEntity('Validation Error', $validator->errors());
        }
        $heading = Heading::find($request->input('heading_id'));

        if (!$heading) {
            return ResponseHelper::notFound('Heading not found');
        }
        $heading->headings = $request->input('headings');
        $heading->save();

        return ResponseHelper::success(['heading' => $heading], 'Heading updated successfully!');
    }

    public function find($id)
    {
        $heading = Heading::find($id);
        if (!$heading) {
            return response()->json(['error' => 'Heading not found'], 404);
        }
        return response()->json(['heading' => $heading]);
    }

    // public function delete(Request $request)
    // {
    //     $heading = Heading::find($request->heading_id);
    //     return response()->json($heading);
    //     $headingText = $request->input('heading'); 

    //     // Validate heading is provided
    //     if (!$headingText) {
    //         return response()->json(['error' => 'Heading text is required'], 422);
    //     }

    //     // Find the heading in the database by text
    //     $heading = Heading::where('headings', $headingText)->first();

    //     if (!$heading) {
    //         return response()->json(['error' => 'Heading not found'], 404);
    //     }

    //     // Delete the heading from the database
    //     $heading->delete();

    //     return response()->json(['message' => 'Heading deleted successfully!']);
    // }

    public function delete(Request $request)
    {
        // Get the heading and heading_id from the request
        $headingToDelete = $request->input('heading');
        $headingId = $request->input('heading_id');

        // Find the heading record by its ID
        $heading = Heading::find($headingId);

        // If the heading is not found, return an error
        if (!$heading) {
            return response()->json(['error' => 'Heading not found'], 404);
        }

        // Remove the specific heading from the headings array
        $updatedHeadings = array_filter($heading->headings, function ($heading) use ($headingToDelete) {
            return $heading !== $headingToDelete;
        });

        // Reindex the array and update the record
        $heading->headings = array_values($updatedHeadings);
        $heading->save();

        // Return success response
        return response()->json(['message' => 'Heading deleted successfully']);
    }
}
