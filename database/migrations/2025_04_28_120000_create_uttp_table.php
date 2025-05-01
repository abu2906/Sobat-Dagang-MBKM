<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUttpTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('uttp', function (Blueprint $table) {
            $table->id('id_uttp'); // Primary key
            $table->foreignId('id_user')->constrained('users')->onDelete('cascade');
            $table->unsignedBigInteger('id_alat_tera');
            $table->foreign('id_alat_tera')->references('id_alat_tera')->on('alat_tera')->onDelete('cascade');
            $table->unsignedBigInteger('id_jenis_alat');
            $table->foreign('id_jenis_alat')->references('id_jenis_alat')->on('jenis_alat')->onDelete('cascade');
            $table->unsignedBigInteger('id_cap');
            $table->foreign('id_cap')->references('id_cap')->on('cap_tanda_tera')->onDelete('cascade');
            
            $table->date('tanggal')->nullable();
            $table->string('no_registrasi')->nullable();
            $table->string('nama_pemilik')->nullable();
            $table->string('nama_usaha')->nullable();
            $table->string('nama_alat')->nullable();
            $table->string('merk_type')->nullable();
            $table->string('nomor_seri')->nullable();
            $table->string('alat_penguji')->nullable();
            $table->text('catatan')->nullable();
            $table->string('spt_keperluan')->nullable();
            $table->string('t_u')->nullable();
            $table->date('tanggal_selesai')->nullable();
            $table->string('terapan')->nullable();
            $table->string('tanda_tangan')->nullable();
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('uttp');
    }
};
