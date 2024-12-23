<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseHelper;
use App\Models\Admission;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;

class AdmissionController extends Controller
{
    public function signup(Request $request)
    {
        // $validated = $request->validate([
        //     'class_id' => 'required|integer',
        //     'email' => 'required|email|unique:admissions',
        //     'password' => 'required|min:8',
        // ]);
        $validated = $request->validate([
            'class_id' => 'required|integer',
            'email' => [
                'required',
                'regex:/^(\d+|[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,})$/',
                'unique:admissions,email',
            ],
            'password' => 'required|min:8',
        ]);

        $admission = Admission::create([
            'assigned_class_id' => $validated['class_id'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        $token = JWTAuth::fromUser($admission);

        return response()->json([
            'access_token' => $token,
            'student_id' => $admission
        ]);
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (!$token = auth('admissions')->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }

    public function studentme()
    {
        $admission = auth('admissions')->user();
        $students = Student::with(['admission', 'admissionassign'])
            ->where('admission_id', $admission->id)
            ->get();

        return ResponseHelper::success($students, 'studentd admission data retrive successfully');
    }

    public function logout()
    {
        auth('admissions')->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }
    protected function respondWithToken($token)
    {
        // Fetch the TTL from the config, multiplied by 60 to convert minutes to seconds
        $ttl = config('jwt.ttl') * 60;

        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => $ttl * 60,
            'student_id' => auth('admissions')->user()->id,
            'email' => auth('admissions')->user()->email,
        ]);
    }
}
