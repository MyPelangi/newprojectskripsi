<?php

namespace App\Models;

use App\Models\Admin;
use App\Models\Pengajuans;
use App\Models\Pembayarans;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PermohonanPenutupan extends Model
{
    use HasFactory;
    protected $table = 'pm_penutupan';

    protected $fillable = [
        'id_pengajuan',
        'ref_penutupan',
        'produk',
        'paket',
        'periode_paket',
        'tanggal_berlaku',
        'tanggal_berakhir',
        'nilai_pertanggungan',
        'premi',
        'status_permohonan',
        'keterangan',
        'tanggal_approval',
        'updated_by',

    ];

    public function pengajuan()
    {
        return $this->belongsTo(Pengajuans::class, 'id_pengajuan');
    }

    public function pembayaran()
    {
        return $this->belongsTo(Pembayarans::class);
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }
}
