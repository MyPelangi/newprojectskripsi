<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pengajuans', function (Blueprint $table) {
            // Tambahkan kolom baru dengan tipe string
            $table->string('status')->nullable();
        });

        // Salin data dari harga_sepeda2 ke merek_sepeda
        DB::statement("UPDATE pengajuans SET status = 'valid'");
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
            $table->dropColumn('status');
        });
    }
};
