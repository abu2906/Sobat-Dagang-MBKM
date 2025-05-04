<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('toko', function (Blueprint $table) {
            $table->id('id_toko'); // Primary Key
            $table->unsignedBigInteger('id_rancangan'); // Foreign Key
            $table->string('nama_toko');
            $table->string('no_register');
            $table->string('kecamatan');
            $table->timestamps();

            // Foreign key constraint
            $table->foreign('id_rancangan')->references('id_rancangan')->on('rencana_kebutuhan_distributor')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('toko');
    }
};
