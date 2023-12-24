<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function signup(Request $request)
    {
        $request->validate([
            'fullname' => 'required|string|max:255',
            'username' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:6',
        ]);

        return response()->json([
            'status' => 'success',
            'data' => [
                'user' => [
                    "id" => 1,
                    "username" => $request->username
                ],
            ],
        ]);
    }

    public function signin(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        return response()->json([
            'status' => 'success',
            'data' => [
                'token' => $request->username,
                'refresh_token' => $request->username,
            ],
        ]);
    }

    public function signout(Request $request)
    {
        return response()->json([
            'status' => 'success',
            'data' => null,
        ]);
    }

    public function refresh(Request $request)
    {

        return response()->json([
            'status' => 'success',
            'data' => [
                'token' => "new token",
                'refresh_token' => "new refresh token",
            ],
        ]);
    }
}
