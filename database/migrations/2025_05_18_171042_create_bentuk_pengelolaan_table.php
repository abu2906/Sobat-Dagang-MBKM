<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBentukPengelolaanTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('bentuk_pengelolaan', function (Blueprint $table) {
            $table->id('id_bentuk_pengelolaan');
            $table->foreignId('id_limbah')->constrained('pengelolaan_limbah')->onDelete('cascade');

            $table->string('dikumpulkan_di_tps');
            $table->string('dikerjasamakan_dengan_pihak_lain_yang_telah_berizin');
            $table->string('dimanfaatkan_untuk_internal_industri');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bentuk_pengelolaan');
    }
};
