<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateForumDiskusiTable extends Migration
{
    public function up()
    {
        Schema::create('forum_diskusi', function (Blueprint $table) {
            $table->id('id_pengaduan'); // Primary Key
            $table->unsignedBigInteger('id_user');     // Foreign Key ke users
            $table->unsignedBigInteger('id_disdag');   // Foreign Key ke disdag
            $table->text('chat')->nullable();          // Isi pengaduan
            $table->timestamp('waktu')->useCurrent();  // Waktu pengaduan
            $table->string('status')->default('menunggu'); // Status
            $table->timestamps();

            // Foreign Key Constraints
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('id_disdag')->references('id_disdag')->on('disdag')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('pengaduan');
    }
}
