<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class ProfileController extends Controller
{
    /**
     * This function will display Admin Profile Page
     */
    public function index()
    {
        return view('admin.profile.index');
    }

    /**
     * This function will update the loggedIn user data
     */
    public function profileUpdate(Request $request)
    {
        $user       =       Auth::user();

        $request->validate([
            'name'      =>      ['required', 'min:3', 'max:100'],
            'email'     =>      ['required', 'email', 'unique:users,email,' . Auth::user()->id],
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
     * This will update the password of the loggedIn user
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
