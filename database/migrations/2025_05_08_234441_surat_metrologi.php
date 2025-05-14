<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('surat_metrologi', function (Blueprint $table) {
            $table->increments('id_surat');
            $table->unsignedBigInteger('user_id');
            $table->string('alamat_alat')->nullable();
            $table->string('dokumen')->nullable();
            $table->enum('jenis_surat',['tera', 'tera_ulang'])->default('tera');
            $table->enum('status', ['Menunggu', 'Disetujui', 'Ditolak'])->default('Menunggu');
            $table->string('dokumen_balasan')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id_user')->on('user')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('surat_metrologi');
    }
};
