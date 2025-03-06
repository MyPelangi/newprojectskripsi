<?php

namespace App\DataTables;

use App\Models\Prediksi;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class PrediksiDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     * @return \Yajra\DataTables\EloquentDataTable
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addIndexColumn()
            ->editColumn('created_at', function ($prediksi) {
                return \Carbon\Carbon::parse($prediksi->created_at)->translatedFormat('d F Y');
            })
            ->addColumn('front_wheel_confidence', function ($prediksi) {
                return $prediksi->front_wheel_confidence ?? '-';
            })
            ->addColumn('handlebar_confidence', function ($prediksi) {
                return $prediksi->handlebar_confidence ?? '-';
            })
            ->addColumn('pedal_confidence', function ($prediksi) {
                return $prediksi->pedal_confidence ?? '-';
            })
            ->addColumn('rear_wheel_confidence', function ($prediksi) {
                return $prediksi->rear_wheel_confidence ?? '-';
            })
            ->addColumn('saddle_confidence', function ($prediksi) {
                return $prediksi->saddle_confidence ?? '-';
            });
    }


    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Prediksi $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Prediksi $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('prediksi-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    //->dom('Bfrtip')
                    ->orderBy(0, 'desc')
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
     *
     * @return array
     */
    public function getColumns(): array
    {
        return [
            Column::make('created_at')->title('Tanggal Prediksi'), // Ganti nama kolom
            Column::make('jenis_gambar')->title('Jenis Gambar'),
            Column::make('front_wheel_confidence')->title('Front Wheel'),
            Column::make('handlebar_confidence')->title('Handlebar'),
            Column::make('pedal_confidence')->title('Pedal'),
            Column::make('rear_wheel_confidence')->title('Rear Wheel'),
            Column::make('saddle_confidence')->title('Saddle'),
            Column::make('status'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'Prediksi_' . date('YmdHis');
    }
}
