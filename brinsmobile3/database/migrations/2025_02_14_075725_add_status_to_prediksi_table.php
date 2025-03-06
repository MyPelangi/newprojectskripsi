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
        Schema::table('prediksi', function (Blueprint $table) {
            $table->enum('status', ['valid', 'invalid'])->nullable()->after('hasil_deteksi');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('prediksi', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
};
