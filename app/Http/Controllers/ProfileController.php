<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function getProfile()
    {

        return response()->json([
            'status' => 'success',
            'data' => [
                'fullname' => "Yahoo",
                'email' => "mail@yahoo.com",
            ],
        ]);
    }
}
