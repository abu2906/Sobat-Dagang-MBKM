<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataIkmTable extends Migration
{
    public function up()
    {
        Schema::create('data_ikm', function (Blueprint $table) {
            $table->id('id_ikm');
            $table->unsignedBigInteger('id_disdag'); // Jika ini relasi, FK bisa ditambahkan nanti

            $table->string('nama_pemilik');
            $table->string('nama_ikm');
            $table->text('alamat');
            $table->string('no_telp', 20);
            $table->string('luas');
            $table->string('jenis_industri');
            $table->string('komoditi');
            $table->integer('jumlah_tenaga_kerja');
            $table->bigInteger('nilai_investasi');
            $table->string('nib');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('data_ikm');
    }
}
