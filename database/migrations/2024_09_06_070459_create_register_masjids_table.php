<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegisterMasjidsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_masjid', function (Blueprint $table) {
            $table->id(); 
            $table->string('gauth_id')->nullable();
            $table->string('gauth_type')->nullable();
            $table->string('nama_masjid');
            $table->text('alamat_masjid');
            $table->string('email');
            $table->string('password');
            $table->enum('role', ['takmir', 'admin_masjid', 'remaja_masjid']);
            $table->string('ketua_masjid')->nullable();
            $table->string('ketua_takmir')->nullable();
            $table->string('ketua_remaja_masjid')->nullable();
            $table->integer('total_jamaah')->nullable();
            $table->integer('total_remaja_masjid')->nullable();
            $table->string('luas_tanah_masjid')->nullable();
            $table->string('deskripsi_masjid')->nullable();
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
        Schema::dropIfExists('register_masjids');
    }
}
