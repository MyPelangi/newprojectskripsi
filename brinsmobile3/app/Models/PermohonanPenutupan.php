<?php

namespace App\Models;

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
        'nomor_polis',
        'produk',
        'paket',
        'periode_paket',
        'tanggal_berlaku',
        'tanggal_berakhir',
        'nilai_pertanggungan',
        'premi',

    ];

    public function pengajuan()
    {
        return $this->belongsTo(Pengajuans::class);
    }

    public function pembayaran()
    {
        return $this->belongsTo(Pembayarans::class);
    }
}
