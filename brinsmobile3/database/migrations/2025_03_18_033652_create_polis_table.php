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
        Schema::create('polis', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_pembayaran');
            $table->string('nomor_polis')->unique();
            $table->unsignedBigInteger('id_user');
            $table->string('nama_pemegang');
            $table->string('jenis_asuransi');
            $table->string('paket');
            $table->string('periode_paket');
            $table->string('periode_asuransi');
            $table->string('nilai_pertanggungan', 10, 2);
            $table->decimal('premi', 10, 2);
            $table->string('cover_note_path');
            $table->string('e_polis_path');
            $table->timestamps();

            $table->foreign('id_pembayaran')->references('id')->on('pembayarans')->onDelete('cascade');
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('polis');
    }
};
