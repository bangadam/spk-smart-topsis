<?php

namespace App\DataTables;

use App\Models\PopulationAssesment;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class PopulationAssesmentDataTable extends DataTable
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

        return $dataTable->addColumn('action', 'population_assesments.datatables_actions');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\PopulationAssesment $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query($population_id = null, PopulationAssesment $model)
    {
        if (request()->has('population_id')) {
            $population_id = request()->get('population_id');
            $model = $model->newQuery()->where('population_id', $population_id);
        } else {
            $model = $model->newQuery();
        }

        return $model->orderBy('date', 'desc');
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
            'date' => ['name' => 'date', 'data' => 'date', 'title' => 'Tanggal'],
            'period_id' => ['name' => 'period_id', 'data' => 'period_id', 'title' => 'Periode'],
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'population_assesments_datatable_' . time();
    }
}
