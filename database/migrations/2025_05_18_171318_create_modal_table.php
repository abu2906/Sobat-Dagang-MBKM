<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateModalTabel extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('modal', function (Blueprint $table) {
            $table->id('id_modal');
            $table->foreignId('id_ikm')->constrained('data_ikm')->onDelete('cascade');

            $table->string('jenis_barang');
            $table->bigInteger('pembelian_penambahan_perbaikan')->default(0); 
            $table->bigInteger('pengurangan_barang_modal')->default(0);      
            $table->bigInteger('penyusutan_barang')->default(0);             
            $table->bigInteger('nilai_taksiran')->default(0);                

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('modal');
    }
};
