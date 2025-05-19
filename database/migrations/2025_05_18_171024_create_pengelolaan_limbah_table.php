<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengelolaanLimbahTabel extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pengelolaan_limbah', function (Blueprint $table) {
            $table->id('id_limbah');
            $table->unsignedBigInteger('id_ikm');
            $table->foreign('id_ikm')->references('id_ikm')->on('data_ikm')->onDelete('cascade');

            $table->string('jenis_limbah');      // limbah cair, padat, B3, dsb
            $table->float('jumlah')->default(0); // dalam satuan ton
            $table->string('bentuk_pengelolaan'); // deskripsi umum
            $table->string('parameter');         // contoh: COD, debit inlet, dsb
            $table->float('banyaknya')->default(0); // nilai parameter (misal: 15.2)

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    
    public function down(): void
    {
        Schema::dropIfExists('pengelolaan_limbah');
    }
};
