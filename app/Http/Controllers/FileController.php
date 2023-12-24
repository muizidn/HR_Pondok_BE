<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FileController extends Controller
{
    public function upload(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $uploadedImage = $request->file('image');
        $imageName = time() . '.' . $uploadedImage->getClientOriginalExtension();

        $uploadedImage->move(public_path('images'), $imageName);

        $imageUrl = asset('images/' . $imageName);

        return response()->json([
            'data' => [
                'url' => $imageUrl,
            ],
        ]);
    }
}
