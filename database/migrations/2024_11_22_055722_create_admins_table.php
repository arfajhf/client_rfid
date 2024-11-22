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
        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->bigInteger('id_penyewa')->nullable()->unique()->unsigned();
            $table->string('username');
            $table->string('password');
            $table->enum('role', ['admin', 'superadmin']);

            $table->foreign('id_penyewa')->references('id')->on('data_penyewas');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admins');
    }
};
