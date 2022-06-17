<?php

namespace App\DataTables;

use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Illuminate\Support\Facades\DB;

class ProductsDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addColumn('action', function (Product $product) {

                $actionBtn = "<div class='actions'>";

                if(Auth::user()->roles()->first()->name === 'Super Admin' || Auth::user()->roles()->first()->name === 'Admin') {
                    $actionBtn .= "<div class='show-product'>
                                       <a href=".route('show.product', ['id' => $product->id])."><i class='fa-solid fa-eye'></i></a>
                                   </div>";
                    $actionBtn .= "<div class='update-product'>
                                       <a href=".route('show.update.product', ['id' => $product->id])."><i class='fa-solid fa-pen-to-square'></i></a>
                                   </div>";
                    $actionBtn .= "<div class='delete-product'>
                                       <button type='button' onclick='showDeleteProduct(".$product.")'><i class='fa-solid fa-trash-can'></i></button>
                                   </div>";
                }

                $actionBtn .= "</div>";

                return $actionBtn;
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Product $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Product $model)
    {
        return $model->newQuery()->orderBy('id');
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('products-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Bfrtip')
                    ->orderBy(1)
                    ->buttons([
                        Button::make()
                    ]);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::make('name')->title(__('Name')),
            Column::make('stock')->title(__('Stock')),
            Column::make('description')->title(__('Description')),
//            Column::make('type')->title(__('Type'))
            Column::computed('action')->title(__('Actions')),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename() :String
    {
        return 'Products_' . date('YmdHis');
    }
}
