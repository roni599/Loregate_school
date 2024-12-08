<?php

namespace App\Http\Controllers;

use App\Models\Admission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;

class AdmissionController extends Controller
{
    /**
     * Create a new AdmissionController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admissions', ['except' => ['login', 'signup']]); // Use 'auth:admissions' guard
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $validatedData = $request->validate([
            'email_mobile' => 'required',
            'password' => 'required',
        ]);

        $credentials = request(['email_mobile', 'password']);

        if (!$token = auth('admissions')->attempt($credentials)) { // Use the 'admissions' guard
            return response()->json(['error' => 'Email/mobile or password is invalid'], 401);
        }

        return $this->respondWithToken($token);
    }

    /**
     * Sign up a new admission.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function signup(Request $request)
    {
        // Validate incoming request data
        $validatedData = $request->validate([
            'class_id' => 'required|integer',
            'email_mobile' => 'required|email|unique:admissions,email_mobile',
            'password' => 'required|min:6',
        ]);

        // Hash the password
        $validatedData['password'] = Hash::make($validatedData['password']);

        // Store the new admission in the database
        $admission = Admission::create([
            'class_id' => $validatedData['class_id'],
            'email_mobile' => $validatedData['email_mobile'],
            'password' => $validatedData['password'],
        ]);

        // Authenticate the admission and generate token
        $credentials = [
            'email_mobile' => $validatedData['email_mobile'],
            'password' => $validatedData['password'],
        ];

        if (!$token = auth('admissions')->attempt($credentials)) {
            return response()->json(['error' => 'Email/mobile or password is invalid'], 401);
        }

        return $this->respondWithToken($token);
    }

    /**
     * Get the authenticated Admission.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json(auth('admissions')->user());
    }

    /**
     * Get all admissions.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function all_admissions()
    {
        $admissions = Admission::all();
        return response()->json($admissions);
    }

    /**
     * Log the admission out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth('admissions')->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(JWTAuth::refresh(JWTAuth::getToken()));
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        $ttl = config('jwt.ttl') * 60; // Fetch TTL from config

        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => $ttl * 60, // Adjusted expiry time
            'user_id' => auth('admissions')->user()->id,
            'name' => auth('admissions')->user()->name,
            'email_mobile' => auth('admissions')->user()->email_mobile,
        ]);
    }
}
