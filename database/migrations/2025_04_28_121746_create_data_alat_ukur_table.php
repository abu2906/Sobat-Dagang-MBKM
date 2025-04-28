<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataAlatUkurTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('data_alat_ukur', function (Blueprint $table) {
            $table->id('id_data_alat');
            $table->foreignId('id_user')->constrained('users')->onDelete('cascade');
            $table->unsignedBigInteger('id_uttp');
            $table->foreign('id_uttp')->references('id_uttp')->on('uttp')->onDelete('cascade');
            $table->date('tanggal_valid');
            $table->date('tanggal_exp');
            $table->string('status');
            $table->string('sertifikat')->nullable();
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_alat_ukur');
    }
};
