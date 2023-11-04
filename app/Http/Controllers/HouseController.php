<?php

namespace App\Http\Controllers;

use App\Models\House;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HouseController extends Controller
{
    public function store(Request $request)
    {
        $filename = $request->file('photo')->store('houses');

        House::create([
            'name' => $request->name,
            'photo' => $filename,
        ]);

        return 'Success';
    }

    public function update(Request $request, House $house)
    {
        $oldFilename = $house->photo;
        $filename = $request->file('photo')->store('houses');

        // TASK: Delete the old file from the storage
        if (Storage::exists($oldFilename)) {
            Storage::delete($oldFilename);
        }
        
        $house->update([
            'name' => $request->name,
            'photo' => $filename,
        ]);

        return 'Success';
    }

    public function download(House $house)
    {
        // TASK: Return the $house->photo file from "storage/app/houses" folder
        // for download in browser

         // Get the file path to the house photo in the "storage/app/houses" folder
        $filePath = storage_path('app/houses/' . $house->photo);
        if (Storage::exists('houses/' . $house->photo)) {
            // Generate a download response with the file
            return response()->download($filePath, $house->photo);
        } else {
            // Handle the case when the file doesn't exist
            return 'File not found';
        }
       
    }
}
