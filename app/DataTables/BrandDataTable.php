<?php

namespace App\DataTables;

use App\Models\Brand;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class BrandDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))

            ->addColumn('action', function ($query) {
                // Edit button
                $editBtn       =   "<a href='" . route('admin.brand.edit', $query->id) . "' class='btn btn-primary'>
                    <i class='far fa-edit'></i></a>";
                // Delete button
                $deleteBtn     =   "<a href='" . route('admin.brand.destroy', $query->id) . "' class='btn btn-danger ml-2 delete-item'>
                     <i class='fas fa-user-times'></i></a>";

                return $editBtn . $deleteBtn;
            })

            // Logo column
            ->addColumn('logo', function ($query) {
                return $img     =   "<img src='" . asset($query->logo) . "' width='100px'></img>";
            })

            // Is featured column
            ->addColumn('is_featured', function ($query) {
                $yes        =       "<i class='badge badge-success'>Yes</i>";
                $no         =       "<i class='badge badge-danger'>No</i>";
                if ($query->is_featured == 1) {
                    return $yes;
                } else {
                    return $no;
                }
            })


            // Status column
            ->addColumn('status', function ($query) {
                if ($query->status) {
                    $button     =       '<label class="custom-switch mt-2">
                                            <input type="checkbox" name="custom-switch-checkbox"
                                            class="custom-switch-input change-status" data-id="' . $query->id . '" checked>
                                            <span class="custom-switch-indicator"></span>
                                        </label>';
                    return $button;
                } else {
                    $button     =       '<label class="custom-switch mt-2">
                                            <input type="checkbox" name="custom-switch-checkbox"
                                            class="custom-switch-input change-status" data-id="' . $query->id . '">
                                            <span class="custom-switch-indicator"></span>
                                        </label>';
                    return $button;
                }
            })

            ->rawColumns(['logo', 'is_featured', 'status', 'action'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Brand $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('brand-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            //->dom('Bfrtip')
            ->orderBy(0)
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

            Column::make('id')->width(100),
            Column::make('logo')->width(200),
            Column::make('name')->width(300),
            Column::make('is_featured')->width(200),
            Column::make('status')->width(200),

            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(200)
                ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Brand_' . date('YmdHis');
    }
}
