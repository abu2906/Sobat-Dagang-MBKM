<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersentasePemilikTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('persentase_pemilik', function (Blueprint $table) {
            $table->id('id_pemilik');
            $table->foreignId('id_ikm')->constrained('data_ikm')->onDelete('cascade');
            $table->decimal('pemerintah_pusat', 5, 2)->default(0); // persen
            $table->decimal('pemerintah_daerah', 5, 2)->default(0); // persen
            $table->decimal('swasta_nasional', 5, 2)->default(0); // persen
            $table->decimal('asing', 5, 2)->default(0); // persen
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('persentase_pemilik');
    }
};
