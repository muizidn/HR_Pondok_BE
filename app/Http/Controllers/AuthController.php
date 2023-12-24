<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['signin', 'signup', 'refresh', 'signout']]);
    }

    public function signup(Request $request)
    {
        $request->validate([
            'fullname' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ]);

        $userId = DB::table('users')->insertGetId([
            'fullname' => $request->fullname,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $user = User::find($userId);

        return response()->json([
            'status' => 'success',
            'data' => [
                'message' => 'User created successfully',
                'user' => $user,
            ],
        ]);
    }

    public function signin(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        $user = DB::table('users')->where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'status' => 'error',
                'errors' => ['Unauthorized'],
            ], 401);
        }

        // You can generate a token or session here if needed

        return response()->json([
            'status' => 'success',
            'data' => [
                'user' => $user,
            ],
        ]);
    }

    public function signout()
    {
        // Implement your signout logic here
        // This may include invalidating tokens or clearing sessions
        // Example: $request->session()->forget('user');

        return response()->json([
            'status' => 'success',
            'data' => [
                'message' => 'Successfully logged out',
            ],
        ]);
    }

    public function refresh()
    {
        // Implement token refresh logic here if needed

        return response()->json([
            'status' => 'success',
            'data' => [
                'message' => 'Token refreshed',
            ],
        ]);
    }
}
