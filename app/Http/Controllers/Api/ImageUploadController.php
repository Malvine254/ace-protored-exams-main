<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ImageUploadController extends Controller
{
    public function upload(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'file' => 'required|string', // Ensure the file is a base64 string
        ]);

        try {
            $fileData = $request->input('file');
            $fileName = Str::random(10) . '.jpg';
            $filePath = 'images/' . $fileName;

            // Decode the base64 file
            $fileContents = base64_decode(preg_replace('/^data:image\/\w+;base64,/', '', $fileData));

            // Store the file in the 'public' disk
            Storage::disk('public')->put($filePath, $fileContents);

            Log::info("Path", ["file_url" => $filePath]);

            // Generate the public URL
            $url = '/storage' . '/' . $filePath;

            return response()->json(['url' => $url], 201); // HTTP 201 for created resources
        } catch (Exception $exception) {
            Log::error("Error uploading image: " . $exception->getMessage());

            return response()->json(['error' => 'File upload failed. Please try again.'], 500);
        }
    }
}
