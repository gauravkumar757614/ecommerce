<?php

namespace App\DataTables;

use App\Models\FlashSaleItem;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class FlashSaleItemDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            // Custom delete button
            ->addColumn('action', function ($query) {
                // Delete button
                $deleteBtn     =   "<a href='" . route('admin.flash-sale.destroy', $query->id) . "' class='btn btn-danger ml-2 delete-item'>
                 <i class='fas fa-user-times'></i></a>";
                return $deleteBtn;
            })
            // showing the name of the product using relation
            ->addColumn('product_name', function ($query) {
                return "<a href=" . route('admin.products.edit', $query->id) . "> " . $query->product->name . " </a>";
            })

            // Toggle button to change show at home value
            ->addColumn('show_at_home', function ($query) {
                if ($query->show_at_home) {
                    $button     =       '<label class="custom-switch mt-2">
                                            <input type="checkbox" name="custom-switch-checkbox"
                                            class="custom-switch-input change-at-home-status" data-id="' . $query->id . '" checked>
                                            <span class="custom-switch-indicator"></span>
                                        </label>';
                    return $button;
                } else {
                    $button     =       '<label class="custom-switch mt-2">
                                            <input type="checkbox" name="custom-switch-checkbox"
                                            class="custom-switch-input change-at-home-status" data-id="' . $query->id . '">
                                            <span class="custom-switch-indicator"></span>
                                        </label>';
                    return $button;
                }
            })

            // Toggle button to change status value
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
            ->rawColumns(['status', 'show_at_home', 'action', 'product_name'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(FlashSaleItem $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('flashsaleitem-table')
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

            Column::make('id'),
            Column::make('product_name'),
            Column::make('show_at_home'),
            Column::make('status'),

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
        return 'FlashSaleItem_' . date('YmdHis');
    }
}
