<?php

namespace App\DataTables;

use App\Models\VendorWithdraw;
use App\Models\WithdrawMethod;
use App\Models\WithdrawRequest;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class VendorWithdrawDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            // Custom buttons
            ->addColumn('action', function ($query) {
                // Show button
                $showBtn       =   "<a href='" . route('vendor.withdraw-show-request', $query->id) . "' class='btn btn-primary'>
            <i class='far fa-eye'></i></a>";
                return $showBtn;
            })

            // Withdraw
            ->addColumn('withdraw_charge', function ($query) {
                return getCurrencyIcon() . $query->withdraw_charge;
            })
            ->addColumn('total_amount', function ($query) {
                return getCurrencyIcon() . $query->total_amount;
            })
            ->addColumn('withdraw_amount', function ($query) {
                return getCurrencyIcon() . $query->withdraw_amount;
            })

            // Status
            ->addColumn('status', function ($query) {
                $yes        =       "<i class='badge bg-success'>Paid</i>";
                $no         =       "<i class='badge bg-warning'>Pending</i>";
                $declined   =       "<i class='badge bg-danger'>Declined</i>";
                if ($query->status == 'pending') {
                    return $no;
                } else if ($query->status == 'paid') {
                    return $yes;
                } else {
                    return $declined;
                }
            })

            ->rawColumns(['action', 'status'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(WithdrawRequest $model): QueryBuilder
    {
        return $model->where('vendor_id', auth()->user()->id)->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('withdrawmethod-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            //->dom('Bfrtip')
            ->orderBy(1)
            ->selectStyleSingle()
            ->buttons([
                Button::make('excel'),
                Button::make('csv'),
                Button::make('pdf'),
                Button::make('print'),
                Button::make('reset'),
                Button::make('reload')
            ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [

            Column::make('id'),
            Column::make('method'),
            Column::make('total_amount'),
            Column::make('withdraw_amount'),
            Column::make('withdraw_charge'),
            Column::make('status'),

            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'VendorWithdraw_' . date('YmdHis');
    }
}
