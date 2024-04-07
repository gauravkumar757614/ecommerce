<?php

namespace App\DataTables;

use App\Models\Blog;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class BlogDataTable extends DataTable
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
                $editBtn       =   "<a href='" . route('admin.blog.edit', $query->id) . "' class='btn btn-primary'>
        <i class='far fa-edit'></i></a>";
                // Delete button
                $deleteBtn     =   "<a href='" . route('admin.blog.destroy', $query->id) . "' class='btn btn-danger ml-2 delete-item'>
         <i class='fas fa-user-times'></i></a>";

                return $editBtn . $deleteBtn;
            })

            // Logo column
            ->addColumn('image', function ($query) {
                return $img     =   "<img src='" . asset($query->image) . "' width='100px'></img>";
            })

            // Rendering blog category
            ->addColumn('category', function ($query) {
                return $query->category->name;
            })

            // Publish date
            ->addColumn('publish_date', function ($query) {
                return date('d-m-y', strtotime($query->created_at));
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
            ->rawColumns(['action', 'status', 'image', 'publish_date'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Blog $model): QueryBuilder
    {
        return $model::with('category')->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('blog-table')
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
            Column::make('title'),
            Column::make('category'),
            // Column::make('slug'),
            // Column::make('description')->width(300),
            // Column::make('seo_title'),
            // Column::make('seo_description'),
            Column::make('status'),
            Column::make('publish_date'),

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
        return 'Blog_' . date('YmdHis');
    }
}
