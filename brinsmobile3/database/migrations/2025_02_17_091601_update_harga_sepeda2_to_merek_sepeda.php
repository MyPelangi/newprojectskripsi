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
            $table->string('merek_sepeda')->nullable();
        });

        // Salin data dari harga_sepeda2 ke merek_sepeda
        DB::statement("UPDATE pengajuans SET merek_sepeda = 'Polygon'");

        Schema::table('pengajuans', function (Blueprint $table) {
            // Hapus kolom lama setelah data disalin
            $table->dropColumn('harga_sepeda2');
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
            // Tambahkan kembali kolom lama dengan tipe decimal
            $table->decimal('harga_sepeda2', 15, 2)->nullable();
        });

        // Kembalikan data dari merek_sepeda ke harga_sepeda2 jika rollback
        DB::statement("UPDATE pengajuans SET harga_sepeda2 = merek_sepeda");

        Schema::table('pengajuans', function (Blueprint $table) {
            // Hapus kolom merek_sepeda setelah rollback
            $table->dropColumn('merek_sepeda');
        });
    }
};
