<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        // Validate the incoming request data
        $validator = Validator::make($request->all(), [
            'fullname' => 'required|string',
            'username' => 'required|string|unique:users',
            'password' => 'required|string|min:6',
            'email' => 'required|string|email|unique:users',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()->all(),
            ], 422);
        }

        // Create a new user
        $user = User::create([
            'fullname' => $request->input('fullname'),
            'username' => $request->input('username'),
            'password' => bcrypt($request->input('password')),
            'email' => $request->input('email'),
        ]);

        // Optionally, you can immediately log in the user after registration
        // Auth::login($user);

        return response()->json([
            'status' => 'success',
            'data' => [
                'user' => $user,
            ],
        ]);
    }

    public function login(Request $request)
    {
        $credentials = $request->only(['username', 'password']);

        // You can also allow users to log in with their email
        $field = filter_var($request->input('username'), FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        $credentials[$field] = $request->input('username');
        unset($credentials['username']);

        if (Auth::attempt($credentials)) {
            $token = auth()->user()->createToken('authToken')->accessToken;

            return response()->json([
                'status' => 'success',
                'data' => [
                    'token' => $token,
                ],
            ]);
        }

        return response()->json([
            'status' => 'error',
            'errors' => ['user_deleted'], // Customize based on your needs
        ], 401);
    }
}
