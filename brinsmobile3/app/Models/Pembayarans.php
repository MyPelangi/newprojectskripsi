<?php

namespace App\Models;

use App\Models\User;
use App\Models\Polis;
use App\Models\PermohonanPenutupan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pembayarans extends Model
{
    use HasFactory;

    protected $table = 'pembayarans';

    protected $fillable = [
        'id_user',
        'id_penutupans',
        'metode_pembayaran',
        'nomor_va',
        'total',
        'status',
        'batas_waktu'
    ];

    public function user()
    {
        return $this->hasMany(User::class);
    }

    public function penutupan()
    {
        return $this->belongsTo(PermohonanPenutupan::class, 'id_penutupans');
    }

    public function polis()
    {
        return $this->belongsTo(Polis::class, 'id_penutupans');
    }
}
