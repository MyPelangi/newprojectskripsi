<?php

namespace App\Models;

use App\Models\Pengajuans;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Prediksi extends Model
{
    use HasFactory;

    protected $table = 'prediksi'; // Nama tabel di database

    protected $fillable = [
        'id_pengajuan',
        'jenis_gambar',
        'path_gambar',
        'hasil_deteksi',
        'status',
        'front_wheel_confidence',
        'handlebar_confidence',
        'pedal_confidence',
        'rear_wheel_confidence',
        'saddle_confidence',
    ];

    /**
     * Relasi ke tabel pengajuans (1 pengajuan bisa memiliki banyak prediksi)
     */
    public function pengajuan()
    {
        return $this->belongsTo(Pengajuans::class, 'id_pengajuan');
    }
}
