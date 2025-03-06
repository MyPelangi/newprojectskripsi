<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'nama' => 'Pelangi Dwi',
                'gender' => 'Perempuan',
                'tempat_lahir' => 'Jakarta',
                'tgl_lahir' => '1995-05-10',
                'no_ktp' => '3201234567890001',
                'kewarganegaraan' => 'Indonesia',
                'status_menikah' => 'Belum Menikah',
                'nama_ibu' => 'Siti Aminah',
                'pekerjaan' => 'Software Engineer',
                'sumber_pendapatan' => 'Gaji',
                'pendapatan_tahunan' => '100000000',
                'tujuan' => 'Asuransi Sepeda',
                'nama_penerima' => 'Budi Santoso',
                'kantor_cabang' => 'BRINS Jakarta',
                'email' => 'andi@example.com',
                'password' => Hash::make('pelangi123'),
                'no_telp' => '081234567890',
                'kode_pos' => '10110',
                'provinsi' => 'DKI Jakarta',
                'kota' => 'Jakarta Selatan',
                'kecamatan_kelurahan' => 'Kebayoran Baru',
                'alamat_lengkap' => 'Jl. Sudirman No.10',
                'alamat_kantor' => 'Jl. Sudirman No.50',
                'no_telp_kantor' => '0219876543',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'nama' => 'Andi Saputra',
                'gender' => 'Laki-laki',
                'tempat_lahir' => 'Bandung',
                'tgl_lahir' => '1998-08-15',
                'no_ktp' => '3201234567890002',
                'kewarganegaraan' => 'Indonesia',
                'status_menikah' => 'Menikah',
                'nama_ibu' => 'Rina Kartika',
                'pekerjaan' => 'Dokter',
                'sumber_pendapatan' => 'Usaha',
                'pendapatan_tahunan' => '200000000',
                'tujuan' => 'Asuransi Sepeda',
                'nama_penerima' => 'Ahmad Rizki',
                'kantor_cabang' => 'BRINS Bandung',
                'email' => 'siti@example.com',
                'password' => Hash::make('andi123'),
                'no_telp' => '081298765432',
                'kode_pos' => '40123',
                'provinsi' => 'Jawa Barat',
                'kota' => 'Bandung',
                'kecamatan_kelurahan' => 'Coblong',
                'alamat_lengkap' => 'Jl. Dago No.20',
                'alamat_kantor' => 'Jl. Pasteur No.100',
                'no_telp_kantor' => '0221234567',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        ]);
    }
}
