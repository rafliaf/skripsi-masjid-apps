<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id(); 
            $table->string('gauth_id')->nullable();
            $table->string('gauth_type')->nullable(); 
            // Foreign key referencing the 'id' field in 'data_masjid'
            $table->foreignId('masjid_id');
            $table->string('nama');
            $table->string('email')->unique();
            $table->enum('role', ['takmir', 'admin_masjid', 'remaja_masjid']);
            $table->string('password');
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
        Schema::dropIfExists('users');
    }
}
