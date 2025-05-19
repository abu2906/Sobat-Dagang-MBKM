<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePendapatanTabel extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pendapatan', function (Blueprint $table) {
            $table->id('id_pendapatan');
            $table->foreignId('id_ikm')->constrained('data_ikm')->onDelete('cascade');

            $table->bigInteger('nilai')->default(0);   // nominal pendapatan dalam Rp
            $table->string('sumber');                  // sumber pendapatan

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pendapatan');
    }
};
