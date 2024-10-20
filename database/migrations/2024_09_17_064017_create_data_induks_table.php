<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataInduksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_induk', function (Blueprint $table) {
            $table->id();
            $table->foreignId('masjid_id')->constrained('data_masjid')->onDelete('cascade');
            $table->foreignId('kartu_keluarga_id')->constrained('data_kartu_keluarga')->onDelete('cascade');
            $table->string('nik');
            $table->string('nama_lengkap');
            $table->string('status_hubungan_keluarga');
            $table->string('tempat_lahir');
            $table->date('tgl_lahir');
            $table->enum('jenis_kelamin', ['laki_laki', 'perempuan']);
            $table->enum('pendidikan', ['belum_sekolah', 'paud', 'tk', 'sd', 'smp', 'smk', 'sma', 'd1', 'd2', 'd3', 'd4', 's1', 's2', 's3']);
            $table->string('pekerjaan');
            $table->string('no_wa');
            $table->enum('status_kawin', ['menikah', 'belum_menikah', 'duda', 'janda']);
            $table->enum('is_remaja_masjid', ['ya', 'tidak']);
            $table->enum('is_status_mukim', ['ya', 'tidak']);
            $table->enum('is_baca_latin', ['ya', 'tidak']);
            $table->enum('is_baca_hijaiyah', ['ya', 'tidak']);
            $table->enum('is_baca_iqro', ['ya', 'tidak']);
            $table->enum('is_baca_quran', ['ya', 'tidak']);
            $table->enum('is_sholat_5_waktu', ['ya', 'tidak']);
            $table->enum('is_sholat_berjamaah', ['ya', 'tidak']);
            $table->enum('is_zakat_fitrah', ['ya', 'tidak']);
            $table->enum('is_zakat_mal', ['ya', 'tidak']);
            $table->enum('is_kurban', ['ya', 'tidak']);
            $table->enum('is_haji', ['ya', 'tidak']);
            $table->enum('is_umrah', ['ya', 'tidak']);
            $table->enum('is_pengajian_rutin', ['ya', 'tidak']);
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
        Schema::dropIfExists('data_induks');
    }
}
