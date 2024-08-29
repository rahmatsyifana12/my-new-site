<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        try {
            // Validate the request data
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:3|confirmed',
            ]);

            // Create a new user
            $user = User::create([
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'password' => Hash::make($validatedData['password']),
                'email_verified_at' => now(),
            ]);

            // Generate a JWT token for the user
            $token = JWTAuth::fromUser($user);

            // Return the token in a JSON response
            return response()->json(['token' => $token], 201);

        } catch (ValidationException $e) {
            // Log validation errors and return a 422 response
            \Log::channel('console')->error('Validation error: ' . $e->getMessage());
            return response()->json(['error' => 'Validation error', 'message' => $e->getMessage()], 422);
        } catch (\Exception $e) {
            // Log unexpected errors and return a 500 response
            \Log::channel('console')->error('Internal Server Error: ' . $e->getMessage());
            return response()->json(['error' => 'Internal Server Error', 'message' => 'Something went wrong.'], 500);
        }
    }

    public function login(Request $request)
    {
        try {
            $credentials = $request->only('email', 'password');

            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'Unauthorized'], 401);
            }

            return response()->json(['token' => $token]);

        } catch (\Exception $e) {
            // Log unexpected errors and return a 500 response
            \Log::channel('console')->error('Internal Server Error: ' . $e->getMessage());
            return response()->json(['error' => 'Internal Server Error', 'message' => 'Something went wrong.'], 500);
        }
    }

    public function getUser()
    {
        try {
            $user = Auth::user();

            if (!$user) {
                return response()->json(['error' => 'User not found'], 404);
            }

            return response()->json(['user' => $user]);

        } catch (\Exception $e) {
            // Log unexpected errors and return a 500 response
            \Log::channel('console')->error('Internal Server Error: ' . $e->getMessage());
            return response()->json(['error' => 'Internal Server Error', 'message' => 'Something went wrong.'], 500);
        }
    }
}
