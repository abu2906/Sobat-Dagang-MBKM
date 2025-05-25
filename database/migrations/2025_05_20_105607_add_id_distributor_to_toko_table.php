<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('toko', function (Blueprint $table) {
            $table->unsignedBigInteger('id_distributor')->after('id_rancangan');

            $table->foreign('id_distributor')
                ->references('id_distributor')
                ->on('distributor')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('toko', function (Blueprint $table) {
            $table->dropForeign(['id_distributor']);
            $table->dropColumn('id_distributor');
        });
    }
};
