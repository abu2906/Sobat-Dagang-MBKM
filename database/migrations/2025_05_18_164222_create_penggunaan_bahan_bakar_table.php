<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenggunaanBahanBakarTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('penggunaan_bahan_bakar', function (Blueprint $table) {
            $table->id('id_bahan_bakar');
            $table->unsignedBigInteger('id_ikm');
            $table->foreign('id_ikm')->references('id_ikm')->on('data_ikm')->onDelete('cascade');

            $table->string('jenis_bahan_bakar');
            $table->string('satuan_standar');

            $table->float('banyaknya_proses_produksi')->default(0);     // jumlah bahan (misal: liter)
            $table->bigInteger('nilai_proses_produksi')->default(0);   // nilai dalam Rp

            $table->float('banyaknya_pembangkit_tenaga_listrik')->default(0);
            $table->bigInteger('nilai_pembangkit_tenaga_listrik')->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penggunaan_bahan_bakar');
    }
};
