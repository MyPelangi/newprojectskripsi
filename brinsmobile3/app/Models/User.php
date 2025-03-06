<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Pengajuans;
use App\Models\Pembayarans;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nama',
        'gender',
        'tempat_lahir',
        'tgl_lahir',
        'no_ktp',
        'kewarganegaraan',
        'status_menikah',
        'nama_ibu',
        'pekerjaan',
        'sumber_pendapatan',
        'pendapatan_tahunan',
        'tujuan',
        'nama_penerima',
        'kantor_cabang',
        'email',
        'password',
        'no_telp',
        'kode_pos',
        'provinsi',
        'kota',
        'kecamatan_kelurahan',
        'alamat_lengkap',
        'alamat_kantor',
        'no_telp_kantor',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'tgl_lahir' => 'date',
    ];

    public function pengajuans()
    {
        return $this->hasMany(Pengajuans::class, 'id_user');
    }

    public function pembayarans()
    {
        return $this->hasMany(Pembayarans::class, 'id_user');
    }
}
