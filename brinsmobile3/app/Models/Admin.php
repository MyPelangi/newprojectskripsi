<?php

namespace App\Models;

use App\Models\PermohonanPenutupan;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use Notifiable;

    protected $guard = 'admin'; // Gunakan guard 'admin'

    protected $fillable = [
        'nama_admin', 'email', 'password', 'divisi', 'kantor_cabang'
    ];

    public function pm_penutupan()
    {
        return $this->belongsTo(PermohonanPenutupan::class);
    }

    protected $hidden = [
        'password',
    ];
}
