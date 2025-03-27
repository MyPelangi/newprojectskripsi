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
        Schema::create('pm_penutupan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_pengajuan')->constrained('pengajuans')->onDelete('cascade');
            $table->string('ref_penutupan')->unique();
            $table->string('produk');
            $table->string('paket');
            $table->string('periode_paket');
            $table->date('tanggal_berlaku');
            $table->date('tanggal_berakhir');
            $table->decimal('premi', 15, 2);
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
        Schema::dropIfExists('pm_penutupan');
    }
};
