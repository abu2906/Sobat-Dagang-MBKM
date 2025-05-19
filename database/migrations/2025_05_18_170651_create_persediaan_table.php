<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersediaanTabel extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('persediaan', function (Blueprint $table) {
            $table->id('id_persediaan');
            $table->foreignId('id_ikm')->constrained('data_ikm')->onDelete('cascade');

            $table->string('jenis_persediaan'); // misal: bahan baku, barang jadi, dll
            $table->bigInteger('awal')->default(0);       // nilai awal dalam Rp
            $table->bigInteger('akhir')->default(0);      // nilai akhir dalam Rp

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('persediaan');
    }
};
