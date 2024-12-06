<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('data_presensis', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_sdm')->unsigned();
            $table->time('jam_masuk');
            $table->time('jam_keluar')->nullable();
            $table->enum('setatus', ['in', 'out']);
            $table->string('keterangan');

            $table->foreign('id_sdm')->references('id')->on('data_sdms');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_presensis');
    }
};
