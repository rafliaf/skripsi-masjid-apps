<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ProgramTakmir extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        // master data
        Schema::create('md_program_takmir', function (Blueprint $table) {
            $table->id();
            $table->foreignId('masjid_id')->constrained('data_masjid')->onDelete('cascade');
            $table->string('jenis_program');
        });
        
        // add data
        Schema::create('data_program_takmir', function (Blueprint $table) {
            $table->id();
            $table->foreignId('masjid_id')->constrained('data_masjid')->onDelete('cascade');
            $table->foreignId('jenis_program_id')->constrained('md_program_takmir')->onDelete('cascade');
            $table->foreignId('data_induk_id')->constrained('data_induk')->onDelete('cascade');
            $table->string('nama_kegiatan');
            $table->string('lokasi_kegiatan');
            $table->dateTime('tgl_mulai');
            $table->dateTime('tgl_selesai');
            $table->string('sasaran_kegiatan');
            $table->string('catatan_pelaksanaan')->nullable();
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
        Schema::dropIfExists('data_program_takmir');
    }
}
