<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class VendorProfileController extends Controller
{
    /**
     * This function will return the profile page of vendor user
     */
    public function index()
    {
        return view('vendor.dashboard.profile');
    }

    /**
     * This will update the basic info section of the user profile
     */
    public function updateProfile(Request $request)
    {
        $user       =       Auth::user();

        $request->validate([
            'name'      =>       ['required', 'max:100'],
            'email'     =>       ['required', 'unique:users,email,'.Auth::user()->id],
            'image'     =>      ['image', 'max:2048']
        ]);

          // This code will upload the image file at public path and store the path in the table
          if($request->hasFile('image'))
          {
              // Before uploading new image deleting the old one
              if(File::exists(public_path(Auth::user()->image)))
              {
                  File::delete(public_path(Auth::user()->image));
              }
              //uploadin new image
              $image      =       $request->image;
              $imageName  =       rand()."_".$image->getClientOriginalName();
              $image->move(public_path('uploads'), $imageName);

              $path       =       "/uploads/".$imageName;
              $user->image    =   $path;
          }

          $user->name     =       $request->name;
          $user->email    =       $request->email;
          $user->save();

          toastr()->success('Profile updated successfully');
          return redirect()->back();
    }

    /**
     * This will change the password of the loggedIn user
     */
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password'      =>      ['required', 'current_password'],
            'password'              =>      ['required', 'confirmed', 'min:8']
        ]);

        $request->user()->update([
            'password'              =>      $request->password
        ]);

        // Giving success message using toastr package
        toastr('Password updated successfully!');
        return redirect()->back();
    }
}
