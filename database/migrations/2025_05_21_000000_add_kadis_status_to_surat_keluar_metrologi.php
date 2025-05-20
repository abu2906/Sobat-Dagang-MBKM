<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('surat_keluar_metrologi', function (Blueprint $table) {
            $table->enum('status_kadis', ['Menunggu', 'Disetujui', 'Ditolak'])->default('Menunggu')->after('status_kepalaBidang');
            $table->text('keterangan_kadis')->nullable()->after('status_kadis');
        });
    }

    public function down(): void
    {
        Schema::table('surat_keluar_metrologi', function (Blueprint $table) {
            $table->dropColumn(['status_kadis', 'keterangan_kadis']);
        });
    }
}; 