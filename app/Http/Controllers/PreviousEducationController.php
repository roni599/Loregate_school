<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseHelper;
use App\Models\PreviousEducation;
use Illuminate\Http\Request;

class PreviousEducationController extends Controller
{
    public function index()
    {
        $previousEducation = PreviousEducation::all();
        return ResponseHelper::success($previousEducation, "Previous Education Data retrive successfully");
    }

    public function store(Request $request)
    {
        $request->validate([
            'newItem' => 'required|string|max:255',
        ]);

        $education = PreviousEducation::create([
            'education_name' => $request->input('newItem'),
        ]);
        return ResponseHelper::success($education, "Previous education data created successfully");
    }
}
