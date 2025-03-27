<?php

namespace App\Models;

use App\Models\User;
use App\Models\Pembayarans;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Polis extends Model
{
    use HasFactory;
    protected $table = 'polis';

    protected $fillable = [
        'id_pembayaran',
        'nomor_polis',
        'id_user',
        'nama_pemegang',
        'jenis_asuransi',
        'paket',
        'periode_paket',
        'periode_asuransi',
        'nilai_pertanggungan',
        'premi',
        'cover_note_path',
        'e_polis_path'

    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function pembayaran()
    {
        return $this->belongsTo(Pembayarans::class);
    }
}
