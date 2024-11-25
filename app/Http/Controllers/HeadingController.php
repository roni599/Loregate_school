<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseHelper;
use App\Models\Heading;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class HeadingController extends Controller
{

    public function index()
    {
        try {
            $heading = Heading::first();
            if (!$heading) {
                return ResponseHelper::notFound('No heading data found');
            }
            return response()->json(['heading' => $heading]);
        } catch (\Exception $e) {
            return ResponseHelper::internalServerError('An error occurred while retrieving heading data', [
                'exception' => $e->getMessage(),
            ]);
        }
    }
    public function storeUpdate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'headings' => 'required|array|min:1',
            'headings.*' => 'required|string|max:255',
        ]);
        if ($validator->fails()) {
            return ResponseHelper::unprocessableEntity('Validation Error', $validator->errors());
        }

        $heading = Heading::first();

        if ($heading) {
            $heading->headings = $request->input('headings');
            $heading->save();
            return ResponseHelper::success(['heading' => $heading], 'Heading updated successfully!');
        } else {
            $validated = $validator->validated();
            $heading = new Heading();
            $heading->headings = $validated['headings'];
            $heading->save();
            return ResponseHelper::success($heading, 'Academy Header saved successfully!');
        }
    }

    public function delete(Request $request)
    {
        $headingToDelete = $request->input('heading');
        $heading = Heading::first();
        if (!$heading) {
            return response()->json(['error' => 'Heading not found'], 404);
        }
        $updatedHeadings = array_filter($heading->headings, function ($heading) use ($headingToDelete) {
            return $heading !== $headingToDelete;
        });
        $heading->headings = array_values($updatedHeadings);
        $heading->save();
        return response()->json(['message' => 'Heading deleted successfully']);
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
}
