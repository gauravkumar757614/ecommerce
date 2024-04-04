<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Vendor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VendorShopProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user       =       User::where('email', 'vendor@gmail.com')->first();
        $vendor     =       new Vendor();

        $vendor->banner         =       'uploads/1234.jpg';
        $vendor->shop_name      =       'Vendor Shop';
        $vendor->phone          =       '1234567890';
        $vendor->email          =       'vendor@gmail.com';
        $vendor->address        =       'USA';
        $vendor->description    =       'shop description';
        $vendor->user_id        =       $user->id;
        $vendor->status         =       1;

        $vendor->save();
    }
}
