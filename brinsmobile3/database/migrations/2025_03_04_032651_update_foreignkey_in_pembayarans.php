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
        Schema::table('pembayarans', function (Blueprint $table) {
            // // Hapus foreign key lama
            // $table->dropForeign(['id_pengajuan']);
            $table->dropColumn('id_penutupan');

            // Tambahkan foreign key baru ke tabel pm_penutupan
            $table->foreignId('id_penutupans')->constrained('pm_penutupan')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pembayarans', function (Blueprint $table) {
            // Hapus foreign key baru
            // $table->dropForeign(['id_penutupan']);
            $table->dropColumn('id_penutupans');

            // Kembalikan foreign key lama
            $table->foreignId('id_penutupan')->constrained('pengajuans')->onDelete('cascade')->after('id_user');
        });
    }
};
