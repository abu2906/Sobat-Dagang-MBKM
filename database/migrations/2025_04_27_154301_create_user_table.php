<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('user', function (Blueprint $table) {
            $table->id('id_user'); // Primary Key
            $table->unsignedBigInteger('id_kecematan'); // Foreign Key
            $table->unsignedBigInteger('id_kelurahan'); // Foreign Key
            $table->string('password');
            $table->string('nik')->unique();
            $table->string('nib')->nullable();
            $table->string('nama');
            $table->text('alamat_lengkap');
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan']);
            $table->string('telp');
            $table->string('email')->unique();
            $table->timestamps();

            // Foreign Key Constraints
            $table->foreign('id_kecematan')
                  ->references('id_kecematan')
                  ->on('kecamatan')
                  ->onDelete('cascade');
            $table->foreign('id_kelurahan')
                  ->references('id_kelurahan')
                  ->on('kelurahan')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
}
