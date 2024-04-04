<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Advertisement;
use App\Traits\ImageUploadTrait;
use Illuminate\Http\Request;

class AdvertisementController extends Controller
{
    use ImageUploadTrait;

    public function index()
    {
        $banner_one             =       Advertisement::where('key', 'homepage_banner_section_one')->first();
        $banner_two             =       Advertisement::where('key', 'homepage_banner_section_two')->first();
        $banner_three           =       Advertisement::where('key', 'homepage_banner_section_three')->first();
        $banner_four            =       Advertisement::where('key', 'homepage_banner_section_four')->first();
        $productpage            =       Advertisement::where('key', 'productpage-banner')->first();
        $cartpage               =       Advertisement::where('key', 'cartpage-banner')->first();

        $banner_one_content     =       json_decode($banner_one?->value,    true);
        $banner_two_content     =       json_decode($banner_two?->value,    true);
        $banner_three_content   =       json_decode($banner_three?->value,  true);
        $banner_four_content    =       json_decode($banner_four?->value,   true);
        $productpage_content    =       json_decode($productpage?->value,   true);
        $cartpage_content       =       json_decode($cartpage?->value,   true);

        // dd($banner_two_content);
        return view(
            'admin.advertisement.index',
            compact(
                'banner_one_content',
                'banner_two_content',
                'banner_three_content',
                'banner_four_content',
                'productpage_content',
                'cartpage_content'
            )
        );
    }

    // Homepage banner section one
    public function homepageBannerSectionOne(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'banner_image'      =>       ['image', 'max:3000'],
            'banner_url'        =>       ['required'],
        ]);

        $file_path      =       $this->updateImage($request, 'banner_image', 'uploads');

        $value = [
            'banner_one'      =>    [
                'banner_url'        =>      $request->banner_url,
                'status'            =>      $request->status == 'on' ? 1 : 0,
            ]
        ];

        if (!empty($file_path)) {
            $value['banner_one']['banner_image']    =   $file_path;
        } else {
            // $data       =       Advertisement::where('key', 'homepage_banner_section_one')->first();
            // $data       =       json_decode($data->value, true);
            // // dd($data);
            $value['banner_one']['banner_image']    =   $request->banner_old_image;
        }

        $value      =       json_encode($value);
        Advertisement::updateOrCreate(
            ['key'      =>      'homepage_banner_section_one'],
            ['value'    =>      $value]
        );


        toastr('Updated successfully!', 'success');
        return redirect()->route('admin.advertisement.index');
    }

    /**
     * Homepage banner section two
     */
    public function homepageBannerSectionTwo(Request $request)
    {
        $request->validate([
            'banner_one_image'      =>       ['image', 'max:3000'],
            'banner_one_url'        =>       ['required'],
            'banner_two_image'      =>       ['image', 'max:3000'],
            'banner_two_url'        =>       ['required'],
        ]);

        $imageOne                   =       $this->updateImage($request, 'banner_one_image', 'uploads');
        $imageTwo                   =       $this->updateImage($request, 'banner_two_image', 'uploads');

        $value = [
            'banner_one'      =>    [
                'banner_url'        =>      $request->banner_one_url,
                'banner_status'     =>      $request->banner_one_status == 'on' ? 1 : 0,
            ],
            'banner_two'      =>    [
                'banner_url'        =>      $request->banner_two_url,
                'banner_status'     =>      $request->banner_one_status == 'on' ? 1 : 0,
            ]
        ];

        // Banner image one
        if (!empty($imageOne)) {
            $value['banner_one']['banner_image']    =   $imageOne;
        } else {
            $value['banner_one']['banner_image']    =   $request->banner_one_old_image;
        }
        // Banner image two
        if (!empty($imageTwo)) {
            $value['banner_two']['banner_image']    =   $imageTwo;
        } else {
            $value['banner_two']['banner_image']    =   $request->banner_two_old_image;
        }

        $value      =       json_encode($value);

        Advertisement::updateOrCreate(
            ['key'      =>      'homepage_banner_section_two'],
            ['value'    =>      $value]
        );


        toastr('Updated successfully!', 'success');
        return redirect()->route('admin.advertisement.index');
    }

    /**
     * Homepage banner section three
     */
    public function homepageBannerSectionThree(Request $request)
    {
        $request->validate([
            'banner_one_image'      =>       ['image', 'max:3000'],
            'banner_one_url'        =>       ['required'],
            'banner_two_image'      =>       ['image', 'max:3000'],
            'banner_two_url'        =>       ['required'],
            'banner_three_image'    =>       ['image', 'max:3000'],
            'banner_three_url'      =>       ['required'],
        ]);

        $imageOne                   =       $this->updateImage($request, 'banner_one_image', 'uploads');
        $imageTwo                   =       $this->updateImage($request, 'banner_two_image', 'uploads');
        $imageThree                 =       $this->updateImage($request, 'banner_three_image', 'uploads');

        $value = [
            'banner_one'        =>    [
                'banner_url'        =>      $request->banner_one_url,
                'banner_status'     =>      $request->banner_one_status == 'on' ? 1 : 0,
            ],
            'banner_two'        =>    [
                'banner_url'        =>      $request->banner_two_url,
                'banner_status'     =>      $request->banner_two_status == 'on' ? 1 : 0,
            ],
            'banner_three'      =>    [
                'banner_url'        =>      $request->banner_three_url,
                'banner_status'     =>      $request->banner_three_status == 'on' ? 1 : 0,
            ]
        ];

        // Banner image one
        if (!empty($imageOne)) {
            $value['banner_one']['banner_image']    =   $imageOne;
        } else {
            $value['banner_one']['banner_image']    =   $request->banner_one_old_image;
        }
        // Banner image two
        if (!empty($imageTwo)) {
            $value['banner_two']['banner_image']    =   $imageTwo;
        } else {
            $value['banner_two']['banner_image']    =   $request->banner_two_old_image;
        }
        // Banner image three
        if (!empty($imageThree)) {
            $value['banner_three']['banner_image']  =   $imageThree;
        } else {
            $value['banner_three']['banner_image']  =   $request->banner_three_old_image;
        }

        $value      =       json_encode($value);

        Advertisement::updateOrCreate(
            ['key'      =>      'homepage_banner_section_three'],
            ['value'    =>      $value]
        );


        toastr('Updated successfully!', 'success');
        return redirect()->route('admin.advertisement.index');
    }

    /**
     * Homepage banner section four
     */
    public function homepageBannerSectionFour(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'banner_image'      =>       ['image', 'max:3000'],
            'banner_url'        =>       ['required'],
        ]);

        $file_path      =       $this->updateImage($request, 'banner_image', 'uploads');

        $value = [
            'banner_one'      =>    [
                'banner_url'        =>      $request->banner_url,
                'status'            =>      $request->status == 'on' ? 1 : 0,
            ]
        ];

        if (!empty($file_path)) {
            $value['banner_one']['banner_image']    =   $file_path;
        } else {
            // $data       =       Advertisement::where('key', 'homepage_banner_section_one')->first();
            // $data       =       json_decode($data->value, true);
            // // dd($data);
            $value['banner_one']['banner_image']    =   $request->banner_old_image;
        }

        $value      =       json_encode($value);
        Advertisement::updateOrCreate(
            ['key'      =>      'homepage_banner_section_four'],
            ['value'    =>      $value]
        );


        toastr('Updated successfully!', 'success');
        return redirect()->route('admin.advertisement.index');
    }

    /**
     * Product page banner
     */
    public function productpageBanner(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'banner_image'      =>       ['image', 'max:3000'],
            'banner_url'        =>       ['required'],
        ]);

        $file_path      =       $this->updateImage($request, 'banner_image', 'uploads');

        $value = [
            'banner_one'      =>    [
                'banner_url'        =>      $request->banner_url,
                'status'            =>      $request->status == 'on' ? 1 : 0,
            ]
        ];

        if (!empty($file_path)) {
            $value['banner_one']['banner_image']    =   $file_path;
        } else {
            // $data       =       Advertisement::where('key', 'homepage_banner_section_one')->first();
            // $data       =       json_decode($data->value, true);
            // // dd($data);
            $value['banner_one']['banner_image']    =   $request->banner_old_image;
        }

        $value      =       json_encode($value);
        Advertisement::updateOrCreate(
            ['key'      =>      'productpage-banner'],
            ['value'    =>      $value]
        );


        toastr('Updated successfully!', 'success');
        return redirect()->route('admin.advertisement.index');
    }

    /**
     * Cart page banner
     */
    public function cartpageBanner(Request $request)
    {
        $request->validate([
            'banner_one_image'      =>       ['image', 'max:3000'],
            'banner_one_url'        =>       ['required'],
            'banner_two_image'      =>       ['image', 'max:3000'],
            'banner_two_url'        =>       ['required'],
        ]);

        $imageOne                   =       $this->updateImage($request, 'banner_one_image', 'uploads');
        $imageTwo                   =       $this->updateImage($request, 'banner_two_image', 'uploads');

        $value = [
            'banner_one'      =>    [
                'banner_url'        =>      $request->banner_one_url,
                'banner_status'     =>      $request->banner_one_status == 'on' ? 1 : 0,
            ],
            'banner_two'      =>    [
                'banner_url'        =>      $request->banner_two_url,
                'banner_status'     =>      $request->banner_one_status == 'on' ? 1 : 0,
            ]
        ];

        // Banner image one
        if (!empty($imageOne)) {
            $value['banner_one']['banner_image']    =   $imageOne;
        } else {
            $value['banner_one']['banner_image']    =   $request->banner_one_old_image;
        }
        // Banner image two
        if (!empty($imageTwo)) {
            $value['banner_two']['banner_image']    =   $imageTwo;
        } else {
            $value['banner_two']['banner_image']    =   $request->banner_two_old_image;
        }

        $value      =       json_encode($value);

        Advertisement::updateOrCreate(
            ['key'      =>      'cartpage-banner'],
            ['value'    =>      $value]
        );


        toastr('Updated successfully!', 'success');
        return redirect()->route('admin.advertisement.index');
    }
}
