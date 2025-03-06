<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->enum('gender', ['Laki-laki', 'Perempuan']);
            $table->string('tempat_lahir');
            $table->date('tgl_lahir'); // Ganti string ke date
            $table->string('no_ktp', 16)->unique(); // KTP biasanya 16 digit
            $table->string('kewarganegaraan');
            $table->enum('status_menikah', ['Belum Menikah', 'Menikah', 'Cerai'])->nullable();
            $table->string('nama_ibu');
            $table->string('pekerjaan');
            $table->enum('sumber_pendapatan', ['Gaji', 'Usaha', 'Investasi', 'Lainnya'])->nullable();
            $table->decimal('pendapatan_tahunan', 15, 2)->nullable(); // Gunakan decimal untuk angka
            $table->string('tujuan')->nullable();
            $table->string('nama_penerima');
            $table->string('kantor_cabang');
            $table->string('email')->unique();
            $table->string('password'); // Laravel secara default bisa menyimpan hash
            $table->string('no_telp', 15); // Batas 15 karakter untuk nomor telepon
            $table->string('kode_pos', 5)->nullable(); // Biasanya kode pos 5 digit
            $table->string('provinsi');
            $table->string('kota');
            $table->string('kecamatan_kelurahan');
            $table->text('alamat_lengkap'); // Ubah ke text agar lebih fleksibel
            $table->text('alamat_kantor')->nullable();
            $table->string('no_telp_kantor', 15)->nullable();
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
