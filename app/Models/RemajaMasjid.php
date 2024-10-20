<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RemajaMasjid extends Model
{
    use HasFactory;
    
    protected $table = 'data_remaja_masjid';

    protected $fillable = [
        'masjid_id',
        'data_induk_id',
        'kartu_keluarga_id',
        'is_remaja_masjid',
    ];

    // get from data induk
    public function dataInduk()
    {
        return $this->belongsTo(DataInduk::class, 'data_induk_id');
    }

    // Relationship with DataKartuKeluarga
    public function kartuKeluarga()
    {
        return $this->belongsTo(DataKartuKeluarga::class, 'kartu_keluarga_id');
    }
}
