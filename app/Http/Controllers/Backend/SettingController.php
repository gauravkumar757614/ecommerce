<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\EmailConfiguration;
use App\Models\GeneralSetting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        $generalSetting        =       GeneralSetting::first();
        $emailSetting        =       EmailConfiguration::first();
        return view('admin.setting.index', compact('generalSetting', 'emailSetting'));
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
}
