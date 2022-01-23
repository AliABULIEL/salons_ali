<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/**
 * @group Upload images
 */
class UploadController extends Controller
{
    /**
     * Upload
     *
     * Upload images
     * @authenticated
     * @bodyParam image file The image.
     * @response {
     *       "message": "Image uploaded successfully",
	 * 		 "image": "uJZoX5RTsWHGwZfkL7DmaFI2y7rb6fi4UgdadqtP.jpg",
     * }
    **/
    public function store(Request $request)
    {
        $data = $request->validate([
            'image' => 'required|mimes:jpeg,jpg,png,gif|max:30000',
        ]);

        $path = $request->image->store('public');
        $path = str_replace('public/', '', $path);

        return [
            'message' => 'Image uploaded successfully',
            'image' => $path
        ];
    }
}
