<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DataKartuKeluarga extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_kartu_keluarga', function (Blueprint $table) {
            $table->id();
            $table->foreignId('masjid_id')->constrained('data_masjid')->onDelete('cascade');
            $table->string('nomor_kk');
            $table->string('no_rt');
            $table->string('nama_kepala_keluarga')->unique();
            $table->string('kode_rumah');
            $table->enum('level_ekonomi', ['menengah_ke_atas', 'menengah', 'menengah_ke_bawah']);
            $table->integer('jumlah_anggota_keluarga');
            $table->string('no_wa');
            $table->string('keterangan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('data_kartu_keluarga');
    }
}
