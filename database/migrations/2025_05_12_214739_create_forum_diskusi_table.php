<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateForumDiskusiTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('forum_diskusi', function (Blueprint $table) {
            $table->id('id_pengaduan'); // Primary key

            $table->unsignedBigInteger('id_user');     // Relasi ke tabel user
            $table->unsignedBigInteger('id_disdag')->nullable(); // Relasi ke tabel disdag (opsional)

            $table->text('chat');      // Isi pesan
            $table->timestamp('waktu')->useCurrent(); // Waktu pengiriman pesan (default sekarang)
            $table->string('status')->default('terkirim'); // Status pesan: 'terkirim', 'dibaca', dsb

            $table->timestamps(); // created_at dan updated_at (otomatis)

            // Foreign key constraints
            $table->foreign('id_user')->references('id_user')->on('user')->onDelete('cascade');
            $table->foreign('id_disdag')->references('id_disdag')->on('disdag')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('forum_diskusi');
    }
}
