<?php

namespace App\DataTables;

use App\Models\GeneralSetting;
use App\Models\ShippingRule;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ShippingRuleDataTable extends DataTable
{

    protected $currencyIcon = '';
    public function __construct()
    {
        $this->currencyIcon = GeneralSetting::first()->currency_icon;
    }

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
                $editBtn       =   "<a href='" . route('admin.shipping-rules.edit', $query->id) . "' class='btn btn-primary'>
        <i class='far fa-edit'></i></a>";
                // Delete button
                $deleteBtn     =   "<a href='" . route('admin.shipping-rules.destroy', $query->id) . "' class='btn btn-danger ml-2 delete-item'>
         <i class='fas fa-user-times'></i></a>";

                return $editBtn . $deleteBtn;
            })
            // Custom icon column
            ->addColumn('icon', function ($query) {
                return '<i style="font-size:40px" class="' . $query->icon . '" ></i>';
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

            // Displaying currency icon with minimum cost and cost
            ->addColumn('min_cost', function ($query) {
                return $this->currencyIcon . $query->min_cost;
            })
            ->addColumn('cost', function ($query) {
                return $this->currencyIcon . $query->cost;
            })

            // Displaying custom badge for type of the rule
            ->addColumn('type', function ($query) {
                if ($query->type === 'flat_cost') {
                    return "<i class='badge badge-warning'> Flat Cost </i>";
                } else {
                    return "<i class='badge badge-success'> Minimum Cost </i>";
                }
            })

            ->rawColumns(['action', 'status', 'type'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(ShippingRule $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('shippingrule-table')
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
            Column::make('name'),
            Column::make('type'),
            Column::make('min_cost'),
            Column::make('cost'),
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
        return 'ShippingRule_' . date('YmdHis');
    }
}
