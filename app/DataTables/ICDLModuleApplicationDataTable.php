<?php

namespace App\DataTables;

use App\Models\ICDLApplication;

use App\Models\ICDLModule;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

;

class ICDLModuleApplicationDataTable extends DataTable
{
   public $icdlModule;

    protected bool $fastExcel = true;

    public function __construct(ICDLModule $icdlModule )
    {
        $this->icdlModule = $icdlModule;
     
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

       return $dataTable;
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\ICDLApplication $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(ICDLApplication $model)
    {
       /* if ($this->organization != null){
            return $model->newQuery()->where("organization_id", $this->organization->id);
        } */
    //dd( $model->newQuery()->where("shipment_id", $this->shipment->id)->get(), $this->shipment->id );
        return $model->newQuery()->where("icdl_module_id", $this->icdlModule->id);
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
           // ->addAction(['width' => '120px', 'printable' => false])
            ->parameters([
                'dom'       => 'Bfrtip',
                'stateSave' => true,
                'order'     => [[1, 'desc']],
                'buttons'   => [
                //    ['extend' => 'create', 'className' => 'btn btn-primary btn-outline btn-xs no-corner',],
                ['extend' => 'excel', 'className' => 'btn btn-primary btn-outline btn-xs no-corner',],
                ['extend' => 'csv', 'className' => 'btn btn-primary btn-outline btn-xs no-corner',],
                ['extend' => 'print', 'className' => 'btn btn-primary btn-outline btn-xs no-corner',],
                    ['extend' => 'reset', 'className' => 'btn btn-primary btn-outline btn-xs no-corner',],
                    ['extend' => 'reload', 'className' => 'btn btn-primary btn-outline btn-xs no-corner',],
                ]
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
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename() : string
    {
        return 'icdl_applicantion_datatable_' . time();
    }
}
