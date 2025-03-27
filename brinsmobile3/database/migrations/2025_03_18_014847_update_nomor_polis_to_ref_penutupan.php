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
            $table->renameColumn('ref_penutupan', 'ref_penutupan');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ref_penutupan', function (Blueprint $table) {
            $table->renameColumn('ref_penutupan', 'ref_penutupan');
        });
    }
};
