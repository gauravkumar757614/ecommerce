<?php

namespace App\Traits;

use Illuminate\Http\Request;

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
            $imageName  =       'media_'.uniqid().'.'.$ext;
            $image->move(public_path($path), $imageName);
            return $path . '/' . $imageName;
        }
    }
}
