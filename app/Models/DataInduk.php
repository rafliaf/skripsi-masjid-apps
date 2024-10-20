<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataInduk extends Model
{
    use HasFactory;

    //table
    protected $table = 'data_induk'; 

    // data yang tidak boleh di isi
    protected $guarded = ['id'];


    // Relationship with Kartu Keluarga
    public function kartuKeluarga()
    {
        return $this->belongsTo(DataKartuKeluarga::class, 'kartu_keluarga_id');
    }

    public function mosque()
    {
        return $this -> belongsTo(RegisterMasjid::class, 'masjid_id');
    }

    public function getPendidikanNameAttribute()
    {
        $pendidikanMapping = [
            'belum_sekolah' => 'Tidak/belum sekolah',
            'paud' => 'PAUD',
            'tk' => 'TK/taman kanak-kanak',
            'sd' => 'SD/sekolah dasar',
            'smp' => 'SMP/sederajat',
            'smk' => 'SMK/sederajat',
            'sma' => 'SMA/sederajat',
            'd1' => 'Diploma I',
            'd2' => 'Diploma II',
            'd3' => 'Diploma III',
            'd4' => 'Diploma IV',
            's1' => 'Sarjana S1',
            's2' => 'Sarjana S2',
            's3' => 'Sarjana S3',
        ];

        return $pendidikanMapping[$this->pendidikan] ?? $this->pendidikan;
    }

    
}
