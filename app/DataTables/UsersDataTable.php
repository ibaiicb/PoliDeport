<?php

namespace App\DataTables;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class UsersDataTable extends DataTable
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
            ->addColumn('rol', function (User $user) {
                return ucfirst($user->getRoleNames()[0]);
            })
            ->addColumn('action', function(User $user) {

                $actionBtn = "<div class='actions'>";

                if (Auth::user()->roles()->first()->name === 'Super Admin') {
                    if ($user->deleted_at !== NULL) {
                        $actionBtn .= "<div class='restore-user'>
                                           <button type='button' onclick='showAlertRestore(".$user.")'><i class='fa-solid fa-user-plus'></i></button>
                                       </div>";
                        $actionBtn .= "<div class='delete-user'>
                                           <button type='button' onclick='showAlertDelete(".$user.")'><i class='fa-solid fa-user-minus'></i></button>
                                       </div>";
                    }else {
                        if($user->roles()->first()->name === 'Client') {
                            $actionBtn .= "<div class='show-user'>
                                               <a href=".route('show.user', ['id' => $user->id])."><i class='fa-solid fa-eye'></i></a>
                                           </div>";
                        }else if ($user->roles()->first()->name === 'Admin') {
                            $actionBtn .= "<div class='update-user'>
                                               <a href=".route('show.update.user', ['id' => $user->id])."><i class='fa-solid fa-user-pen'></i></a>
                                           </div>";
                        }
                        $actionBtn .= "<div class='soft-delete-user'>
                                           <button type='button' onclick='showAlertSoftDelete(".$user.")'><i class='fa-solid fa-trash-can'></i></button>
                                       </div>";
                    }
                }else if (Auth::user()->roles()->first()->name === 'Admin') {
                    if ($user->roles()->first()->name === 'Client' && $user->deleted_at !== NULL) {
                        $actionBtn .= "<div class='restore-user'>
                                           <button type='button' onclick='showAlertRestore(".$user.")'><i class='fa-solid fa-user-plus'></i></button>
                                       </div>";
                        $actionBtn .= "<div class='delete-user'>
                                           <button type='button' onclick='showAlertDelete(".$user.")'><i class='fa-solid fa-user-minus'></i></button>
                                       </div>";
                    }else if($user->roles()->first()->name === 'Admin' || $user->roles()->first()->name === 'Client'){
                        $actionBtn .= "<div class='show-user'>
                                           <a href=".route('show.user', ['id' => $user->id])."><i class='fa-solid fa-eye'></i></a>
                                       </div>";
                    }else if ($user->roles()->first()->name === 'Client') {
                        $actionBtn .= "<div class='soft-delete-user'>
                                           <button type='button' onclick='showAlertSoftDelete(".$user.")'><i class='fa-solid fa-trash-can'></i></button>
                                       </div>";
                    }
                }

                $actionBtn .= '</div>';

                return $actionBtn;
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(User $model)
    {
        return $model->withTrashed()->whereNotIn('id', [Auth::user()->id, '1'])->orderBy('id');
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('users-table')
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
            Column::make('name')->title( __('Name')),
            Column::make('username')->title( __('Username')),
            Column::make('address')->title( __('Address')),
            Column::make('email')->title( __('Email')),
            Column::make('rol')->title( __('Role')),
            Column::computed('action')->title( __('Actions')),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename() :String
    {
        return 'Users_' . date('YmdHis');
    }
}
