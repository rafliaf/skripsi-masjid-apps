<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegisterMasjid extends Model implements AuthenticatableContract
{
    use HasFactory, Authenticatable;

    protected $table = 'data_masjid'; 

    // data yang tidak boleh di isi
    protected $guarded = ['id'];

    protected $hidden = [
        'password',
    ];

        // function relationship ORM masjid dapat memiliki banyak user
        public function user()
        {
            return $this -> hasMany(User::class);
        }

        // function relationship ORM masjid dapat memiliki banyak user data_kk
        public function userDataKK()
        {
            return $this -> hasMany(DataKartuKeluarga::class);
        }

}
