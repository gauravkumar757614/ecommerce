<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\FooterInfo;
use App\Traits\ImageUploadTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class FooterInfoController extends Controller
{
    use ImageUploadTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $footerInfo     =       FooterInfo::first();
        return view('admin.footer.footer-info.index', compact('footerInfo'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'logo'      =>       ['nullable', 'image', 'max:3000'],
            'phone'     =>       ['max:100'],
            'email'     =>       ['max:100'],
            'address'   =>       ['max:300'],
            'copywrite' =>       ['max:200'],
        ]);

        $footerInfo     =       FooterInfo::find($id);
        // Handling image upload through ImageUpload Trait
        $imagePath                  =       $this->updateImage($request, 'logo', 'uploads', $footerInfo?->logo);

        FooterInfo::updateOrCreate(
            ['id'=> $id],
            [
                'logo'      =>      empty(!$imagePath) ? $imagePath : $footerInfo->logo,
                'phone'     =>      $request->phone,
                'email'     =>      $request->email,
                'address'   =>      $request->address,
                'copywrite' =>      $request->copywrite,
            ]
        );

        // Clearing the previous cached info after updating
        Cache::forget('footer_info');

        toastr('Updated Successfully!', 'success', 'success');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
