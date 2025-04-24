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
            $table->enum('status_permohonan', ['pending', 'disetujui', 'ditolak'])
                  ->default('pending')
                  ->after('premi');

            $table->text('keterangan')->nullable()->after('status_permohonan');

            $table->timestamp('tanggal_approval')->nullable()->after('keterangan');

            $table->foreignId('updated_by')
                  ->nullable()
                  ->constrained('admins') // atau 'admins', sesuaikan dengan struktur project kamu
                  ->nullOnDelete()
                  ->after('tanggal_approval');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pm_penutupan', function (Blueprint $table) {
            $table->dropColumn('status_permohonan');
            $table->dropColumn('keterangan');
            $table->dropColumn('tanggal_approval');
            $table->dropForeign(['updated_by']);
            $table->dropColumn('updated_by');
        });
    }
};
