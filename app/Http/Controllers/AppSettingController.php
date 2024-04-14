<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AppSetting;
use App\Models\Gallery;
use Illuminate\Support\Str;

class AppSettingController extends Controller
{
    public function index()
    {
        return view('system.setting.setting-view', [
            'appSetting' => AppSetting::first(),
            'galleries' => Gallery::all()
        ]);
    }

    public function update(Request $request)
    {
        $appSetting = AppSetting::first();
        $data = $request->validate([
           'mission' =>'required',
            'vision' =>'required',
        ]);

        $appSetting->update($data);

        return redirect()->route('setting.index')->with('success', 'App Setting Updated Successfully');
    }

    public function addGalleryImage(Request $request)
    {
        $request->validate([
            'file.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Validate each file
        ]);
    
        // Handle file upload
        if ($request->hasFile('file')) {
            foreach ($request->file('file') as $file) {
                // Generate a unique filename using UUID
                $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();

                // Store the file in the storage/app/public directory with the unique filename
                $path = $file->storeAs('public/gallery', $filename);

                // Save the file path to the database or perform other actions
                // For example, if you have a Gallery model:
                $galleryImage = new Gallery();
                $galleryImage->file = $filename;
                $galleryImage->save();
            }
        }

        // Redirect back with a success message or do other actions as needed
        return redirect()->back()->with('success', 'Images uploaded successfully.');
        
    }

    public function deleteGalleryImage(Request $request, Gallery $gallery)
    {
        $gallery->delete();
        //also delte the file from storage
        \Storage::delete('public/gallery/'. $gallery->file);
        return redirect()->back()->with('success', 'Image deleted successfully.');
    }
}
