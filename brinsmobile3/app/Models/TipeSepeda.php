<?php

namespace App\Models;

use App\Models\Pengajuans;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TipeSepeda extends Model
{
    use HasFactory;
    protected $table = 'tipesepeda'; // Nama tabel di database

    protected $fillable = [
        'id',
        'tipe_sepeda'
    ];
    
    public function pengajuans()
    {
        return $this->hasMany(Pengajuans::class, 'tipe_sepeda');
    }
}
