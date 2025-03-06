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
            $table->decimal('front_wheel_confidence', 5, 2)->nullable();
            $table->decimal('handlebar_confidence', 5, 2)->nullable();
            $table->decimal('pedal_confidence', 5, 2)->nullable();
            $table->decimal('rear_wheel_confidence', 5, 2)->nullable();
            $table->decimal('saddle_confidence', 5, 2)->nullable();
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
            $table->dropColumn([
                'front_wheel_confidence',
                'handlebar_confidence',
                'pedal_confidence',
                'rear_wheel_confidence',
                'saddle_confidence',
            ]);
        });
    }
};
