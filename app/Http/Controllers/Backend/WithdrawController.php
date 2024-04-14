<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\WithdrawRequestDataTable;
use App\Http\Controllers\Controller;
use App\Models\WithdrawRequest;
use Illuminate\Http\Request;

class WithdrawController extends Controller
{
    public function index(WithdrawRequestDataTable $dataTable)
    {
        return $dataTable->render('admin.withdraw.index');
    }

    public function show(string $id)
    {
        $withdraw       =       WithdrawRequest::findOrFail($id);
        return view('admin.withdraw.show', compact('withdraw'));
    }

    public function update(string $id, Request $request)
    {
        $request->validate([
            'status'        =>      ['required', 'in:pending,paid,declined']
        ]);

        $withdraw           =       WithdrawRequest::findOrFail($id);
        $withdraw->status   =       $request->status;
        $withdraw->save();

        toastr('Updated successfully!', 'success', 'success');
        return redirect()->route('admin.withdraw.index');
    }
}
