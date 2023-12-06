<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class PresensiController extends Controller
{
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'photo' => 'required|string',
            'username' => 'required|string',
            'time' => 'required|date_format:Y-m-d H:i:s',
        ]);

        if ($validator->fails()) {
            return $this->errorResponse(422, $validator->errors()->all());
        }

        try {
            DB::table('presensi')->insert([
                'username' => $request->input('username'),
                'time' => $request->input('time'),
                'photo' => $request->input('photo'),
            ]);

            return $this->successResponse(['valid' => true]);
        } catch (\Exception $e) {
            return $this->errorResponse(500, [$e->getMessage()]);
        }
    }

    public function status(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'date' => 'required|date_format:Y-m-d',
            'username' => 'required|string',
        ]);

        if ($validator->fails()) {
            return $this->errorResponse(400, ['Invalid date format. Please use yyyy-MM-dd.']);
        }

        try {
            $count = DB::table('presensi')
                ->where('username', $request->input('username'))
                ->whereDate('time', $request->input('date'))
                ->count();

            return $this->successResponse(['data_present' => $count > 0]);
        } catch (\Exception $e) {
            return $this->errorResponse(500, $e->getMessage());
        }
    }

    private function successResponse($data)
    {
        return response()->json([
            'status' => 'success',
            'data' => $data,
        ], 201);
    }

    private function errorResponse($status, $errors = null)
    {
        return response()->json([
            'status' => 'error',
            'errors' => $errors,
        ], $status);
    }
}
