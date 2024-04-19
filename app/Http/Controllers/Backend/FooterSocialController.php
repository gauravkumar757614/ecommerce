<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\FooterSocialDataTable;
use App\Http\Controllers\Controller;
use App\Models\FooterSocial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class FooterSocialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(FooterSocialDataTable $dataTable)
    {
        return $dataTable->render('admin.footer.footer-socials.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.footer.footer-socials.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'icon'      =>      ['required', 'max:200'],
            'name'      =>      ['required', 'max:200'],
            'url'       =>      ['required', 'url'],
            'status'    =>      ['required'],
        ]);

        $footerSocial          =   new FooterSocial();
        $footerSocial->icon    =   $request->icon;
        $footerSocial->name    =   $request->name;
        $footerSocial->url     =   $request->url;
        $footerSocial->status  =   $request->status;
        $footerSocial->save();

        // Clearing the previous cached socials after storing
        Cache::forget('footer_socials');

        toastr('Created Successfully!', 'success', 'success');
        return redirect()->route('admin.footer-socials.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $footerSocial       =       FooterSocial::findOrFail($id);
        return view('admin.footer.footer-socials.edit', compact('footerSocial'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'icon'      =>      ['nullable', 'max:200'],
            'name'      =>      ['nullable', 'max:200'],
            'url'       =>      ['nullable', 'url'],
            'status'    =>      ['nullable'],
        ]);

        $footerSocial          =   FooterSocial::findOrFail($id);
        $footerSocial->icon    =   $request->icon;
        $footerSocial->name    =   $request->name;
        $footerSocial->url     =   $request->url;
        $footerSocial->status  =   $request->status;
        $footerSocial->save();

        // Clearing the previous cached socials after storing
        Cache::forget('footer_socials');

        toastr('Updated Successfully!', 'success', 'success');
        return redirect()->route('admin.footer-socials.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $footerSocial       =       FooterSocial::findOrFail($id);
        $footerSocial->delete();

        // Clearing the previous cached socials after storing
        Cache::forget('footer_socials');
        return response(['status' => 'success', 'message' => 'Deleted Successfully!']);
    }

    /**
     * Change status of specified resource from storage
     */
    public function changeStatus(Request $request)
    {
        $footerSocial               =       FooterSocial::findOrFail($request->id);
        $footerSocial->status       =       $request->status == 'true' ? 1 : 0;
        $footerSocial->save();

        // Clearing the previous cached socials after storing
        Cache::forget('footer_socials');
        return response(['status' => 'success', 'message' => 'status updated successfully!']);
    }
}
