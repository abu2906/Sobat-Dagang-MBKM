<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateForumDiskusiTable extends Migration
{
    public function up()
    {
    Schema::create('forum_diskusi', function (Blueprint $table) {
        $table->id('id_pengaduan');
        $table->unsignedBigInteger('id_user');
        $table->unsignedBigInteger('id_disdag')->nullable();
        $table->text('chat');
        $table->timestamp('waktu');
        $table->string('status');

        $table->foreign('id_user')->references('id_user')->on('user')->onDelete('cascade');
        // foreign key id_disdag sesuai dengan tabel disdag (pastikan benar)
        $table->foreign('id_disdag')->references('id_disdag')->on('disdag')->onDelete('cascade');
    });

    }

    public function down()
    {
        Schema::dropIfExists('pengaduan');
    }
}
