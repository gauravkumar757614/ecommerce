<?php

namespace App\DataTables;

use App\Models\Product;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ProductDataTable extends DataTable
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
                // Edit button
                $editBtn       =   "<a href='" . route('admin.products.edit', $query->id) . "' class='btn btn-primary'>
                <i class='far fa-edit'></i></a>";

                // Delete button
                $deleteBtn     =   "<a href='" . route('admin.products.destroy', $query->id) . "' class='btn btn-danger ml-2 delete-item'>
                 <i class='fas fa-user-times'></i></a>";

                // More custom buttons
                $settings      =    '<div class="dropdown dropleft d-inline ml-1">
                                        <button class="btn btn-primary dropdown-toggle"
                                                type="button" id="dropdownMenuButton2"
                                                data-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="false">

                                                <i class="fas fa-cog"></i>

                                        </button>

                                        <div class="dropdown-menu">

                                        <a class="dropdown-item has-icon" href="' . route("admin.products-image-gallery.index", ['product' => $query->id]) . '"><i class="far fa-heart"></i> Images Gallery </a>
                                        <a class="dropdown-item has-icon" href="' . route("admin.products-image-gallery.index") . '"><i class="far fa-file"></i> Another action</a>
                                        <a class="dropdown-item has-icon" href="' . route("admin.products-image-gallery.index") . '"><i class="far fa-clock"></i> Something else here</a>

                                        </div>

                                    </div>';

                return $editBtn . $deleteBtn . $settings;
            })

            // Custom image column
            ->addColumn('image', function ($query) {
                return $image      =    "<img src='" . asset($query->thumb_image) . "' width='50'></img>";
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

            // Custom icon column
            ->addColumn('type', function ($query) {
                switch ($query->product_type) {
                    case 'new_arrival':
                        return "<i class='badge badge-dark'>'" . $query->product_type . "'</i>";
                        break;
                    case 'featured_product':
                        return "<i class='badge badge-success'>'" . $query->product_type . "'</i>";
                        break;
                    case 'top_product':
                        return "<i class='badge badge-info'>'" . $query->product_type . "'</i>";
                        break;
                    case 'best_product':
                        return "<i class='badge badge-warning'>'" . $query->product_type . "'</i>";
                        break;

                    default:
                        return "<i class='badge badge-success'></i>";
                        break;
                }
            })

            ->rawColumns(['action', 'image', 'status', 'type'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Product $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('product-table')
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
            Column::make('image'),
            Column::make('name'),
            Column::make('price'),
            Column::make('type')->width(150),
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
        return 'Product_' . date('YmdHis');
    }
}
