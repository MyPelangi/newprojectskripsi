<?php

namespace App\DataTables;

use Carbon\Carbon;
use Illuminate\Support\Arr;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use App\Models\PermohonanPenutupan;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;

class PermohonanPenutupanDataTable extends DataTable
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
            ->addColumn('ref_penutupan', function ($penutupan) {
                return $penutupan->ref_penutupan ?? '-'; // Ambil dari relasi penutupan
            })
            ->addColumn('produk', function ($penutupan) {
                return $penutupan->produk ?? '-'; // Ambil dari relasi penutupan
            })
            ->addColumn('paket', function ($penutupan) {
                return $penutupan->paket ?? '-'; // Ambil dari relasi penutupan
            })
            ->addColumn('status_permohonan', function ($penutupan) {
                return ucfirst($penutupan->status_permohonan ?? '-');
            })
            ->editColumn('created_at', function ($penutupan) {
                return Carbon::parse($penutupan->created_at)->translatedFormat('d F Y'); // Format tanggal
            })
            ->addColumn('aksi', function ($row) {
                return view('admin.partials.action', compact('row'))->render();
            })
            ->filter(function ($query) {
                $columns = request()->input('columns', []);

                $status = Arr::get($columns, '5.search.value');
                if (!empty($status)) {
                    $query->where('status_permohonan', 'like', "%$status%");
                }

                $tanggal = Arr::get($columns, '1.search.value');
                if (!empty($tanggal)) {
                    try {
                        $formattedDate = \Carbon\Carbon::parse($tanggal)->format('Y-m-d');
                        $query->whereDate('created_at', $formattedDate);
                    } catch (\Exception $e) {
                        // Format tanggal tidak sesuai, lewati saja
                    }
                }
            })
            ->setRowId('id')
            ->rawColumns(['aksi']); ;
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\PermohonanPenutupan $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(PermohonanPenutupan $model): QueryBuilder
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
                    ->setTableId('permohonanpenutupan-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    //->dom('Bfrtip')
                    ->orderBy(1)
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
            Column::make('ref_penutupan')->title('No Referensi')->searchable(true),
            Column::make('produk')->title('Produk'),
            Column::make('paket')->title('Paket'),
            Column::make('status_permohonan')->title('Status'),
            Column::computed('aksi') // ✅ sesuai dengan nama kolom di atas
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'PermohonanPenutupan_' . date('YmdHis');
    }
}
