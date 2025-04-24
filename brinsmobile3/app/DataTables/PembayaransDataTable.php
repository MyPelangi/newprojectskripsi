<?php

namespace App\DataTables;

use App\Models\Pembayarans;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use Carbon\Carbon;

class PembayaransDataTable extends DataTable
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
            ->addColumn('ref_penutupan', function ($pembayaran) {
                return $pembayaran->penutupan->ref_penutupan ?? '-'; // Ambil dari relasi penutupan
            })
            ->addColumn('nama_user', function ($pembayaran) {
                return $pembayaran->penutupan->pengajuan->user->nama ?? '-'; // Menampilkan nama atau "-" jika null
            })
            ->addColumn('produk', function ($pembayaran) {
                return $pembayaran->penutupan->produk ?? '-'; // Ambil dari relasi penutupan
            })
            ->addColumn('paket', function ($pembayaran) {
                return $pembayaran->penutupan->paket ?? '-'; // Ambil dari relasi penutupan
            })
            ->editColumn('created_at', function ($pembayaran) {
                return Carbon::parse($pembayaran->created_at)->translatedFormat('d F Y'); // Format tanggal
            })
            ->setRowId('id')
            ->filterColumn('nama_user', function ($query, $keyword) {
                $query->whereHas('penutupan.pengajuan.user', function ($q) use ($keyword) {
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
     * @param \App\Models\Pembayaran $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Pembayarans $model): QueryBuilder
    {
        return $model->newQuery()
        ->with(['penutupan', 'user']) // ← tambahkan user di sini
        ->whereHas('penutupan')
        ->orderByDesc('created_at');    }


    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('pembayarans-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    // ->dom('Bfrtip')
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
            Column::make('DT_RowIndex')->title('No')->searchable(false)->orderable(false),
            Column::make('created_at')->title('Tanggal')->searchable(true),
            Column::make('nama_user')->title('Nama'),
            Column::make('produk')->title('Produk'),
            Column::make('ref_penutupan')->title('No Referensi')->searchable(true),
            Column::make('paket')->title('Paket'),
            Column::make('total')->title('Total'),
            Column::make('status')->title('Status')
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'Pembayarans_' . date('YmdHis');
    }
}
