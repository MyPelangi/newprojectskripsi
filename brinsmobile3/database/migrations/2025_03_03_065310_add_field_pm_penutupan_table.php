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
        Schema::table('pm_penutupan', function (Blueprint $table) {
            // Tambahkan kolom baru dengan tipe string
            $table->decimal('nilai_pertanggungan', 15, 2)->after('tanggal_berakhir');
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
            // Hapus kolom merek_sepeda setelah rollback
            $table->dropColumn('nilai_pertanggungan');
        });
    }
};
