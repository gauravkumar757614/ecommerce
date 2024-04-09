<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\EmailConfiguration;
use App\Models\GeneralSetting;
use App\Models\LogoSetting;
use App\Traits\ImageUploadTrait;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    use ImageUploadTrait;

    public function index()
    {
        $generalSetting         =       GeneralSetting::first();
        $emailSetting           =       EmailConfiguration::first();
        $logoSetting            =       LogoSetting::first();

        return view('admin.setting.index', compact('generalSetting', 'emailSetting', 'logoSetting'));
    }

    /**
     * Storing the settings in the storage
     */
    public function generalSettingUpdate(Request $request)
    {
        $request->validate([
            'site_name'         =>      ['required', 'max:200'],
            'layout'            =>      ['required', 'max:200'],
            'contact_email'     =>      ['required', 'max:200'],
            'contact_phone'     =>      ['nullable'],
            'contact_address'   =>      ['nullable'],
            'map'               =>      ['nullable', 'url'],
            'currency_name'     =>      ['required', 'max:200'],
            'currency_icon'     =>      ['required', 'max:200'],
            'timezone'          =>      ['required', 'max:200'],
        ]);

        GeneralSetting::updateOrCreate(
            ['id' => 1],
            [
                'site_name'         =>      $request->site_name,
                'layout'            =>      $request->layout,
                'contact_email'     =>      $request->contact_email,
                'contact_phone'     =>      $request->contact_phone,
                'contact_address'   =>      $request->contact_address,
                'map'               =>      $request->map,
                'currency_name'     =>      $request->currency_name,
                'currency_icon'     =>      $request->currency_icon,
                'time_zone'         =>      $request->timezone,
            ]

        );

        toastr('Updated Successfully!', 'success');
        return redirect()->back();
    }

    /**
     * Update email configuration in the storage
     */
    public function emailConfiguration(Request $request)
    {
        $request->validate([
            'email'             =>      ['required', 'email', 'max:200'],
            'host'              =>      ['required', 'max:200'],
            'username'          =>      ['required', 'max:200'],
            'password'          =>      ['required', 'max:200'],
            'port'              =>      ['required', 'max:200'],
            'encryption'        =>      ['required', 'max:200'],
        ]);

        EmailConfiguration::updateOrCreate(
            ['id' => 1],
            [
                'email'         =>      $request->email,
                'host'          =>      $request->host,
                'username'      =>      $request->username,
                'password'      =>      $request->password,
                'port'          =>      $request->port,
                'encryption'    =>      $request->encryption,
            ]
        );

        toastr('Updated Successfully!', 'success');
        return redirect()->back();
    }

    public function logoSettingUpdate(Request $request)
    {
        $request->validate([
            'logo'          =>      ['nullable', 'image', 'max:3000'],
            'favicon'       =>      ['nullable', 'image', 'max:3000'],
        ]);


        $logoPath           =       $this->updateImage($request, 'logo', 'uploads', $request->old_logo);
        $faviconPath        =       $this->updateImage($request, 'favicon', 'uploads', $request->old_favicon);

        LogoSetting::updateOrCreate(
            ['id' => 1],
            [
                'logo'          =>  !empty($logoPath)           ? $logoPath         : $request->old_logo,
                'favicon'       =>  !empty($faviconPath)        ? $faviconPath      : $request->old_favicon
            ]
        );

        toastr('Updated successfully!', 'success', 'success');
        return redirect()->back();
    }
}
