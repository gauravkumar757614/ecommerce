<?php

namespace App\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

trait ImageUploadTrait
{

    /**
     * Upload Image method
     */
    public function uploadImage(Request $request, $inputName, $path)
    {
        // This code will upload the image file at public path and store the path in the table
        if ($request->hasFile($inputName)) {
            //uploading new image
            $image      =       $request->{$inputName};
            $ext        =       $image->getClientOriginalExtension();
            $imageName  =       'media_' . uniqid() . '.' . $ext;
            $image->move(public_path($path), $imageName);
            return $path . '/' . $imageName;
        }
    }

    /**
     * Upload Multiple Image method
     */
    public function uploadMultipleImage(Request $request, $inputName, $path)
    {
        $imagePaths = [];
        // This code will upload the image file at public path and store the path in the table
        if ($request->hasFile($inputName)) {
            //uploading new image
            $images      =       $request->{$inputName};
            foreach ($images as $image) {
                $ext        =       $image->getClientOriginalExtension();
                $imageName  =       'media_' . uniqid() . '.' . $ext;
                $image->move(public_path($path), $imageName);
                $imagePaths[] = $path . '/' . $imageName;
            }
            return $imagePaths;
        }
    }



    /**
     * Update Image method
     */
    public function updateImage(Request $request, $inputName, $path, $oldPath = null)
    {
        // This code will upload the image file at public path and store the path in the table
        if ($request->hasFile($inputName)) {
            // Before uploading new image deleting the old one
            if (File::exists(public_path($oldPath))) {
                File::delete(public_path($oldPath));
            }
            //uploading new image
            $image      =       $request->{$inputName};
            $ext        =       $image->getClientOriginalExtension();
            $imageName  =       'media_' . uniqid() . '.' . $ext;
            $image->move(public_path($path), $imageName);
            return $path . '/' . $imageName;
        }
    }

    /**
     * Image delete function when we want to delete a row from database
     */
    public function deleteImage($path)
    {
        // Checking if the file exists if yes than deleting it
        if (File::exists(public_path($path))) {
            File::delete(public_path($path));
        }
    }
}
