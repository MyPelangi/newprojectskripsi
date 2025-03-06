<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use Notifiable;

    protected $guard = 'admin'; // Gunakan guard 'admin'

    protected $fillable = [
        'nama_admin', 'email', 'password', 'divisi', 'kantor_cabang'
    ];

    protected $hidden = [
        'password',
    ];
}
