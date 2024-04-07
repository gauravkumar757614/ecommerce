<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Mail\AccountCreatedMail;
use App\Models\User;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ManageUserController extends Controller
{
    public function index()
    {
        return view('admin.manage-user.index');
    }

    public function create(Request $request)
    {
        $request->validate([
            'name'      =>      ['required', 'max:200'],
            'email'     =>      ['required', 'email', 'unique:users,email'],
            'password'  =>      ['required', 'min:8', 'confirmed'],
            'role'      =>      ['required']
        ]);


        switch ($request->role) {
            case 'user':
                $user               =       new User();
                $user->name         =       $request->name;
                $user->email        =       $request->email;
                $user->password     =       $request->password;
                $user->role         =       'user';
                $user->status       =       'active';
                $user->save();

                Mail::to($request->email)->send(new AccountCreatedMail($request->name, $request->email, $request->password));

                toastr('User account created successfully!', 'success', 'success');
                return redirect()->back();
                break;

            case 'vendor':
                // First create user
                $user               =       new User();
                $user->name         =       $request->name;
                $user->email        =       $request->email;
                $user->password     =       $request->password;
                $user->role         =       'vendor';
                $user->status       =       'active';
                $user->save();

                // After creating user save data to vendor db
                $vendor             =       new Vendor();
                $vendor->banner     =       'uploads/1234.jpg';
                $vendor->shop_name  =       $request->name . ' Shop';
                $vendor->phone      =       '1234567890';
                $vendor->email      =       'test@gmail.com';
                $vendor->address    =       'USA';
                $vendor->description =      'shop description';
                $vendor->user_id    =       $user->id;
                $vendor->status     =       1;

                $vendor->save();
                Mail::to($request->email)->send(new AccountCreatedMail($request->name, $request->email, $request->password));

                toastr('Vendor account created successfully!', 'success', 'success');
                return redirect()->back();

            case 'admin':
                // First create user
                $user               =       new User();
                $user->name         =       $request->name;
                $user->email        =       $request->email;
                $user->password     =       $request->password;
                $user->role         =       'admin';
                $user->status       =       'active';
                $user->save();

                // Admin is also a vendor
                // After creating user save data to vendor db
                $vendor             =       new Vendor();
                $vendor->banner     =       'uploads/1234.jpg';
                $vendor->shop_name  =       $request->name . ' Shop';
                $vendor->phone      =       '1234567890';
                $vendor->email      =       'test@gmail.com';
                $vendor->address    =       'USA';
                $vendor->description =      'shop description';
                $vendor->user_id    =       $user->id;
                $vendor->status     =       1;
                $vendor->save();
                Mail::to($request->email)->send(new AccountCreatedMail($request->name, $request->email, $request->password));

                toastr('Admin account created successfully!', 'success', 'success');
                return redirect()->back();

            default:
                toastr('Something went wrong!', 'error', 'error');
                return redirect()->back();
                break;
        }
    }
}
