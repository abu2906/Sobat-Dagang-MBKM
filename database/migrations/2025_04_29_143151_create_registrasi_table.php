<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegistrasiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registrasi', function (Blueprint $table) {
            $table->id();
            $table->string('password', 100);
            $table->string('nama_lengkap', 255);
            $table->string('email_aktif', 150);
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan']);
            $table->string('nik', 16);
            $table->string('nib', 20);
            $table->string('nomor_hp', 20);
            $table->string('alamat_lengkap', 255);
            $table->string('kabupaten', 100); 
            $table->string('kecamatan', 100);
            $table->string('kelurahan', 100);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('registrasi');
    }
}
