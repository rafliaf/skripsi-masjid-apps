<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    //table
    protected $table = 'users'; 

    // data yang tidak boleh di isi
    protected $guarded = ['id'];

     // function relationship user hanya memiliki 1 masjid
     public function masjid()
     {
         return $this -> belongsTo(RegisterMasjid::class, 'masjid_id');
     }
}
