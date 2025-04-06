<?php

namespace App\DataTables;

use App\Models\User;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

;


class UserDataTable extends DataTable
{
    protected $organization;

    protected bool $fastExcel = true;

    public function __construct(){
        
    }

    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        $dataTable = new EloquentDataTable($query);

        return $dataTable->addColumn('action', 'pages.users.datatables_actions');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(User $model)
    {
       /* if ($this->organization != null){
            return $model->newQuery()->where("organization_id", $this->organization->id);
        } */

        if(auth()->user()->email == "admin@app.com"){
            return $model->newQuery();
        }

        
        return $model->newQuery()->where("email","<>","admin@app.com");
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->addAction(['width' => '120px', 'printable' => false])
            ->parameters([
                'dom'       => 'Bfrtip',
                'stateSave' => true,
                'order'     => [[0, 'desc']],
                'buttons'   => [
               //     ['extend' => 'create', 'className' => 'btn btn-primary btn-outline btn-xs no-corner',],
               ['extend' => 'excel', 'className' => 'btn btn-primary btn-outline btn-xs no-corner',],
               ['extend' => 'csv', 'className' => 'btn btn-primary btn-outline btn-xs no-corner',],
               ['extend' => 'print', 'className' => 'btn btn-primary btn-outline btn-xs no-corner',],
                    ['extend' => 'reset', 'className' => 'btn btn-primary btn-outline btn-xs no-corner',],
                    ['extend' => 'reload', 'className' => 'btn btn-primary btn-outline btn-xs no-corner',],
                ],
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
            'name',
            'email',
            'telephone',
            'email',
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename() : string
    {
        return 'users_datatable_' . time();
    }
}
