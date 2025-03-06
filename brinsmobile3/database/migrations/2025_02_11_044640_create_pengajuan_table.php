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
        Schema::create('pengajuans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_user');
            $table->decimal('harga_sepeda', 15, 2);
            $table->string('kode_promo')->nullable();
            $table->string('plan');
            $table->decimal('premi', 15, 2);
            $table->decimal('total', 15, 2);
            $table->decimal('harga_sepeda2', 15, 2);
            $table->string('warna_sepeda');
            $table->unsignedBigInteger('tipe_sepeda');
            $table->string('no_rangka_sepeda')->unique();
            $table->string('model_sepeda');
            $table->string('tahun_produksi');
            $table->string('seri_sepeda');
            $table->string('no_invoice_pembelian');
            $table->string('dok_ktp');
            $table->string('dok_invoice_pembelian');
            $table->boolean('snk')->default(false);
            $table->timestamps();

            // Foreign keys
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
        Schema::table('pengajuans', function (Blueprint $table) {
            //
        });
    }
};
