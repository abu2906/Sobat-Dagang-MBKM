<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSertifikatHalalTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('sertifikat_halal', function (Blueprint $table) {
            $table->id('id_halal');
            $table->unsignedBigInteger('id_user');
            $table->unsignedBigInteger('id_ikm');

            $table->string('nama_ikm');
            $table->string('nomor_sertifikat');
            $table->text('alamat');
            $table->date('tanggal_sah');
            $table->date('tanggal_exp');
            $table->string('link_dokumen');

            $table->timestamps();

            // Foreign Keys
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('id_ikm')->references('id_ikm')->on('data_ikm')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sertifikat_halal');
    }
}
