<?php

namespace App\DataTables;

use App\Models\Pengajuans;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\SearchPane;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;

class PengajuansDataTable extends DataTable
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
            ->addColumn('nama_user', function ($pengajuan) {
                return $pengajuan->user->nama ?? '-'; // Menampilkan nama atau "-" jika null
            })
            ->editColumn('created_at', function ($pengajuan) {
                return \Carbon\Carbon::parse($pengajuan->created_at)->translatedFormat('d F Y');
            })
            ->addColumn('action', 'pengajuans.action')
            ->setRowId('id')
            ->filterColumn('nama_user', function ($query, $keyword) {
                $query->whereHas('user', function ($q) use ($keyword) {
                    $q->where('nama', 'like', "%$keyword%");
                });
            })
            ->filterColumn('created_at', function ($query, $keyword) {
                $query->whereDate('created_at', $keyword);
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Pengajuan $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Pengajuans $model): QueryBuilder
    {
        return $model->newQuery()->with('user')->orderByDesc('created_at');
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('pengajuans-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    // ->dom('lBfrtip')
                    ->orderBy(5, 'desc')
                    ->selectStyleSingle()
                    ->buttons([
                        Button::make('reset')
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
            Column::make('DT_RowIndex')->title('No'),
            Column::make('nama_user')->title('Nama User'), // Tambahkan ini
            Column::make('produk'),
            Column::make('plan'),
            Column::make('premi'),
            Column::make('created_at')->title('Tanggal Pengajuan'), // Ganti nama kolom
            Column::make('status')
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'Pengajuans_' . date('YmdHis');
    }
}
