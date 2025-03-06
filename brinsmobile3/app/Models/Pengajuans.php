<?php

namespace App\Models;

use App\Models\User;
use App\Models\Prediksi;
use App\Models\TipeSepeda;
use App\Models\Pembayarans;
use App\Models\PermohonanPenutupan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pengajuans extends Model
{
    use HasFactory;

    protected $table = 'pengajuans';

    protected $fillable = [
        'id_user',
        'produk',
        'harga_sepeda',
        'kode_promo',
        'plan',
        'premi',
        'total',
        'merek_sepeda',
        'warna_sepeda',
        'tipe_sepeda',
        'no_rangka_sepeda',
        'model_sepeda',
        'tahun_produksi',
        'seri_sepeda',
        'no_invoice_pembelian',
        'dok_ktp',
        'dok_invoice_pembelian',
        'snk',
        'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function tipeSepeda()
    {
        return $this->belongsTo(TipeSepeda::class, 'tipe_sepeda');
    }

    public function pembayaran()
    {
        return $this->belongsTo(Pembayarans::class, 'id_pengajuan');
    }

    public function permohonanpenutupan()
    {
        return $this->belongsTo(PermohonanPenutupan::class, 'id_pengajuan');
    }

    public function prediksi()
    {
        return $this->hasMany(Prediksi::class, 'id_pengajuan');
    }
}
