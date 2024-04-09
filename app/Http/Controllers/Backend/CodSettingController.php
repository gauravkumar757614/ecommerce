<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\CodSetting;
use Illuminate\Http\Request;

class CodSettingController extends Controller
{
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'status'                =>       ['required', 'integer'],
        ]);

        CodSetting::updateOrCreate(
            ['id'           =>      1],
            [
                'status'            =>      $request->status,
            ]
        );
        toastr('Updated Successfully!', 'success', 'Success');
        return redirect()->back();
    }
}
