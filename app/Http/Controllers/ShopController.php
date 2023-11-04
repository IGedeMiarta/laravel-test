<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ShopController extends Controller
{
    public function store(Request $request)
    {
        $filename = $request->file('photo')->getClientOriginalName();
        $request->file('photo')->storeAs('shops', $filename);

        // TASK: resize the uploaded image from /storage/app/shops/$filename
        //   to size of 500x500 and store it as /storage/app/shops/resized-$filename
        // Use intervention/image package, it's already pre-installed for you
        // Resize the uploaded image
        $originalImage = Image::make(storage_path('app/shops/' . $filename));

        // Resize the image to 500x500 pixels
        $originalImage->resize(500, 500);

        // Store the resized image
        $resizedFilename = 'resized-' . $filename;
        $originalImage->save(storage_path('app/shops/' . $resizedFilename));

        return 'Success';
    }
}
