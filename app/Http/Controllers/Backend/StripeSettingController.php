<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\StripeSetting;
use Illuminate\Http\Request;

class StripeSettingController extends Controller
{
    /**
     * Only update method for stripe payment
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'status'        =>       ['required', 'integer'],
            'mode'          =>       ['required', 'integer'],
            'country_name'  =>       ['required', 'string', 'max:200'],
            'currency_name' =>       ['required', 'string', 'max:200'],
            'currency_rate' =>       ['required'],
            'client_id'     =>       ['required'],
            'secret_key'    =>       ['required'],
        ]);

        StripeSetting::updateOrCreate(
            ['id'           =>      1],
            [
                'status'        =>      $request->status,
                'mode'          =>      $request->mode,
                'country_name'  =>      $request->country_name,
                'currency_name' =>      $request->currency_name,
                'currency_rate' =>      $request->currency_rate,
                'client_id'     =>      $request->client_id,
                'secret_key'    =>      $request->secret_key,
            ]
        );
        toastr('Updated Successfully!', 'success', 'Success');
        return redirect()->back();
    }
}
