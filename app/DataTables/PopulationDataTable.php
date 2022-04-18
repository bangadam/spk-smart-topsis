<?php

namespace App\DataTables;

use App\Models\Population;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class PopulationDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        $dataTable = new EloquentDataTable($query);

        return $dataTable->addColumn('action', 'populations.datatables_actions');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Population $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Population $model)
    {
        $query = $model->newQuery();

        // if role is surveyor
        if (auth()->user()->hasRole('surveyor')) {
            $query = $query->where('created_by', auth()->user()->id);
        }

        return $query;
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
                    ['extend' => 'create', 'className' => 'btn btn-default btn-sm no-corner',],
                    ['extend' => 'export', 'className' => 'btn btn-default btn-sm no-corner',],
                    ['extend' => 'print', 'className' => 'btn btn-default btn-sm no-corner',],
                    ['extend' => 'reset', 'className' => 'btn btn-default btn-sm no-corner',],
                    ['extend' => 'reload', 'className' => 'btn btn-default btn-sm no-corner',],
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
            'card_id_number' => ['title' => 'Nomor KTP'],
            'name'          => ['title' => 'Nama'],
            'phone_number' => ['title' => 'Nomor Telepon'],
            'gender' => ['title' => 'Jenis Kelamin'],
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'populations_datatable_' . time();
    }
}
