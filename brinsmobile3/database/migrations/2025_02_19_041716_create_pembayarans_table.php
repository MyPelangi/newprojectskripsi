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
        Schema::create('pembayarans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_user')->constrained('users')->onDelete('cascade');
            $table->foreignId('id_pengajuan')->constrained('pengajuans')->onDelete('cascade');
            $table->string('metode_pembayaran', 50);
            $table->string('nomor_va', 30);
            $table->decimal('total', 10, 2);
            $table->enum('status', ['pending', 'lunas', 'gagal'])->default('pending');
            $table->dateTime('batas_waktu');
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
        Schema::dropIfExists('pembayarans');
    }
};
