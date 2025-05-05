<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBarangTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('barang', function (Blueprint $table) {
            $table->id('id_barang'); // Primary Key
            $table->string('nama_barang'); // Atribut
            $table->unsignedBigInteger('id_index_kategori'); // Foreign Key
            $table->foreign('id_index_kategori')
                ->references('id_index_kategori')
                ->on('index_kategori')
                ->onDelete('cascade'); // Optional
            $table->timestamps(); // created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barang');
    }
}
