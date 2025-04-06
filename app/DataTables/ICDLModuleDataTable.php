<?php

namespace App\DataTables;

use App\Models\ICDLModule;

use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

;

class ICDLModuleDataTable extends DataTable
{
   

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

        return $dataTable->addColumn('full_description',function($row){
            return \Str::limit($row->full_description, 500, '...');
        })->addColumn('image', function ($row) {
            return '<img style="width: 40px; height: 40px;" src="'.asset( $row->image) . '">' ;
        })->addColumn('action', 'pages.icdl_modules.datatables_actions')->rawColumns(['image','full_description', 'action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\ICDLModule $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(ICDLModule $model)
    {
       /* if ($this->organization != null){
            return $model->newQuery()->where("organization_id", $this->organization->id);
        } */
    //dd( $model->newQuery()->where("shipment_id", $this->shipment->id)->get(), $this->shipment->id );
        return $model->newQuery()->where('parent_id', null);
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
             'short_description',
             'full_description',
            [ 'title' =>  'Image','name' => 'Module Image', 'data' => 'image'],
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename() : string
    {
        return 'claimable_items_datatable_' . time();
    }
}
