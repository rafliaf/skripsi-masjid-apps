<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataKartuKeluarga extends Model
{
    use HasFactory;

    //table
    protected $table = 'data_kartu_keluarga'; 

    // data yang tidak boleh di isi
    protected $guarded = ['id'];

    // public function getRouteKeyName()
    // {
    //     return 'nama_kepala_keluarga';
    // }

    // function relationship user data_kk hanya memiliki 1 masjid
    public function userMasjidKK()
    {
        return $this -> belongsTo(RegisterMasjid::class, 'masjid_id');
    }

    // Relationship with RemajaMasjid
    public function remajaMasjid()
    {
        return $this->hasMany(RemajaMasjid::class, 'kartu_keluarga_id');
    }

}
