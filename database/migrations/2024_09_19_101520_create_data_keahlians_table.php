<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataKeahliansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // master data
        Schema::create('md_data_keahlian', function (Blueprint $table) {
            $table->id();
            $table->foreignId('masjid_id')->constrained('data_masjid')->onDelete('cascade');
            $table->string('jenis_keahlian');
        });

        // data keahlian
        Schema::create('data_keahlian', function (Blueprint $table) {
            $table->id();
            $table->foreignId('masjid_id')->constrained('data_masjid')->onDelete('cascade');
            $table->foreignId('jenis_keahlian_id')->constrained('md_data_keahlian')->onDelete('cascade');
            $table->foreignId('data_induk_id')->constrained('data_induk')->onDelete('cascade');
            $table->string('keahlian_lain')->nullable();
            $table->string('deskripsi_keahlian')->nullable();
            $table->enum('is_sertifikat', ['ya', 'tidak'])->nullable();
            $table->string('deskripsi_sertifikat')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('data_keahlians');
    }
}
