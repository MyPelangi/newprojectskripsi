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
        Schema::create('prediksi', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_pengajuan'); // Foreign key ke pengajuans
            $table->enum('jenis_gambar', ['tampak_depan', 'tampak_kiri', 'tampak_kanan', 'tampak_belakang']); // Tipe gambar
            $table->string('path_gambar'); // Lokasi file gambar
            $table->json('hasil_deteksi'); // Hasil YOLO dalam JSON
            $table->timestamps();

            $table->foreign('id_pengajuan')->references('id')->on('pengajuans')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('prediksi');
    }
};
