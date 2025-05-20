<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('surat_keluar_metrologi', function (Blueprint $table) {
            $table->text('isi_surat')->after('tanggal')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('surat_keluar_metrologi', function (Blueprint $table) {
            $table->dropColumn('isi_surat');
        });
    }
};
