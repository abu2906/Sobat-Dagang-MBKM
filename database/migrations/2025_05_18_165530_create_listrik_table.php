<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateListrikTabel extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('listrik', function (Blueprint $table) {
            $table->id('id_listrik');
            $table->foreignId('id_ikm')->constrained('data_ikm')->onDelete('cascade');

            $table->string('sumber');             // PLN, genset, dll
            $table->float('banyaknya')->default(0); // kWh
            $table->bigInteger('nilai')->default(0); // nilai dalam Rp
            $table->string('peruntukkan');        // misal: produksi, administrasi, dll

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('listrik');
    }
};
