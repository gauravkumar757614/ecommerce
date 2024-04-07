<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\BlogCategoryDataTable;
use App\Http\Controllers\Controller;
use App\Models\BlogCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class BlogCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(BlogCategoryDataTable $dataTable)
    {
        return $dataTable->render('admin.blog.blog-category.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.blog.blog-category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'name'          =>      ['required', 'max:200', 'unique:blog_categories'],
                'status'        =>      ['required']
            ],
            [
                'name.unique'   =>      'Category already exists'
            ]
        );

        $blog           =       new BlogCategory();
        $blog->name     =       $request->name;
        $blog->slug     =       Str::slug($request->name);
        $blog->status   =       $request->status;
        $blog->save();

        toastr('Blog Category created successfully!', 'success', 'success');
        return redirect()->route('admin.blog-category.index');
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
        $blog       =       BlogCategory::findOrFail($id);
        return view('admin.blog.blog-category.edit', compact('blog'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate(
            [
                'name'          =>      ['required', 'max:200', 'unique:blog_categories,name,' . $id],
                'status'        =>      ['required']
            ],
            [
                'name.unique'   =>      'Category already exists'
            ]
        );

        $blog           =       BlogCategory::findOrFail($id);
        $blog->name     =       $request->name;
        $blog->slug     =       Str::slug($request->name);
        $blog->status   =       $request->status;
        $blog->save();

        toastr('Blog Category updated successfully!', 'success', 'success');
        return redirect()->route('admin.blog-category.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $blog           =       BlogCategory::findOrFail($id);
        $blog->delete();
        return response(['status' => 'success', 'message' => 'Deleted successfully!']);
    }

    /**
     * Change status of specified resource from storage
     */
    public function changeStatus(Request $request)
    {
        $blog               =       BlogCategory::findOrFail($request->id);
        $blog->status       =       $request->status == 'true' ? 1 : 0;
        $blog->save();
        return response(['message' => 'status has been changed successfully!']);
    }
}
