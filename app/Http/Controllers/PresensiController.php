<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PresensiController extends Controller
{
    public function getPresensiStatus(Request $request)
    {
        $request->validate([
            'presensi_at' => 'required|date',
        ]);

        $presensiDate = $request->input('presensi_at');

        $presensiStatus = 'example_status'; 

        return response()->json([
            'status' => 'success',
            'data' => [
                'presensi_status' => $presensiStatus,
            ],
        ]);
    }

    public function postPresensi(Request $request)
    {
        $request->validate([
            'image_url' => 'required|string',
            'time' => 'required|date',
        ]);

        $imageUrl = $request->input('image_url');
        $time = $request->input('time');


        return response()->json([
            'status' => 'success',
            'data' => [
                'message' => 'Presensi recorded successfully'
            ],
        ]);
    }
}
