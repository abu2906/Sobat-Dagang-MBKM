<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePemakaianBahanTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pemakaian_bahan', function (Blueprint $table) {
            $table->id('id_pemakaian_bahan');
            $table->unsignedBigInteger('id_ikm');
            $table->foreign('id_ikm')->references('id_ikm')->on('data_ikm')->onDelete('cascade');

            $table->string('nama_bahan');
            $table->string('jenis_bahan');
            $table->string('spesifikasi');
            $table->string('kode_hs');
            $table->string('satuan_standar');

            $table->integer('jumlah_dalam_negeri');
            $table->bigInteger('nilai_dalam_negeri');

            $table->integer('jumlah_impor');
            $table->bigInteger('nilai_impor');
            $table->string('negara_asal_impor');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemakaian_bahan');
    }
};
