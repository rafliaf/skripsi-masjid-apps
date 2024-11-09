<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class DataKeahlian extends Model
{

    use HasFactory; // Tambahkan trait HasFactory

    protected $table = 'data_keahlian';

    protected $guarded = ['id'];

    public $timestamps = false;

    // Relationship with the mosque
    public function mosque()
    {
        return $this->belongsTo(RegisterMasjid::class, 'masjid_id');
    }

    // Relationship with the type of skill (jenis_keahlian)
    public function jenisKeahlian()
    {
        return $this->belongsTo(MdDataKeahlian::class, 'jenis_keahlian_id');
    }

    // Relationship with the person (data_induk)
    public function dataInduk()
    {
        return $this->belongsTo(DataInduk::class, 'data_induk_id');
    }
}
