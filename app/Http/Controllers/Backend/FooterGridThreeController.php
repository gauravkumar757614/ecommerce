<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\FooterGridThreeDataTable;
use App\Http\Controllers\Controller;
use App\Models\FooterGridThree;
use App\Models\FooterTitle;
use Illuminate\Http\Request;

class FooterGridThreeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(FooterGridThreeDataTable $dataTable)
    {
        $footerTitle        =       FooterTitle::first();
        return $dataTable->render('admin.footer.footer-grid-three.index', compact('footerTitle'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.footer.footer-grid-three.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'      =>      ['required', 'max:200'],
            'url'       =>      ['required', 'url'],
            'status'    =>      ['required'],
        ]);

        $grid          =   new FooterGridThree();
        $grid->name    =   $request->name;
        $grid->url     =   $request->url;
        $grid->status  =   $request->status;
        $grid->save();
        toastr('Created Successfully!', 'success', 'success');
        return redirect()->route('admin.footer-grid-three.index');
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
        $grid       =       FooterGridThree::findOrFail($id);
        return view('admin.footer.footer-grid-three.edit', compact('grid'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name'      =>      ['required', 'max:200'],
            'url'       =>      ['required', 'url'],
            'status'    =>      ['required'],
        ]);

        $grid          =   FooterGridThree::findOrFail($id);
        $grid->name    =   $request->name;
        $grid->url     =   $request->url;
        $grid->status  =   $request->status;
        $grid->save();
        toastr('Updated Successfully!', 'success', 'success');
        return redirect()->route('admin.footer-grid-three.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $grid       =       FooterGridThree::findOrFail($id);
        $grid->delete();
        return response(['message' => 'Deleted Successfully!']);
    }

    /**
     * Change status of specified resource from storage
     */
    public function changeStatus(Request $request)
    {
        $grid               =       FooterGridThree::findOrFail($request->id);
        $grid->status       =       $request->status == 'true' ? 1 : 0;
        $grid->save();
        return response(['status' => 'success', 'message' => 'status updated successfully!']);
    }

    /**
     * Change title of specified resource from storage
     */
    public function changeTitle(Request $request)
    {
        $request->validate([
            'title'         =>       ['required', 'max:200']
        ]);

        FooterTitle::updateOrCreate(
            ['id' => 1] ,
                [
                    'footer_grid_three_title'     =>      $request->title
                ]
        );

        toastr('Title updated successfully!', 'success', 'success');
        return redirect()->back();
    }
}
