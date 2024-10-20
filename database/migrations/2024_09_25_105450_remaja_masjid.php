<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemajaMasjid extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_remaja_masjid', function (Blueprint $table) {
            $table->id();
            $table->foreignId('masjid_id')->constrained('data_masjid')->onDelete('cascade');
            $table->foreignId('data_induk_id')->constrained('data_induk')->onDelete('cascade');
            $table->foreignId('kartu_keluarga_id')->constrained('data_kartu_keluarga')->onDelete('cascade');
            $table->enum('is_remaja_masjid', ['ya', 'tidak']);
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
        Schema::dropIfExists('data_remaja_masjid');
    }
}
