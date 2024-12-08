<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseHelper;
use App\Models\FormName;
use Illuminate\Http\Request;

class FormNameController extends Controller
{
    public function index()
    {
        $formName = FormName::all();
        return ResponseHelper::success($formName, "FormName data retrive successfully");
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $formname = FormName::create([
            'name' => $request->name,
        ]);

        return ResponseHelper::success($formname, "Form Name assign successfully");
    }

    public function updateStatus(Request $request, $id)
    {
        $validated = $request->validate([
            'isChecked' => 'required|boolean',
        ]);

        $form = FormName::findOrFail($id);
        $form->status = $validated['isChecked'];
        $form->save();

        return response()->json(['message' => 'Form status updated successfully!']);
    }
    public function statusIndex()
    {
        $formName = FormName::where('status', 1)->get();
        return ResponseHelper::success($formName, "FormName data retrieved successfully");
    }
}
