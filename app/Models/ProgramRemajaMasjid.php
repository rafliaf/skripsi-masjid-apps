<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgramRemajaMasjid extends Model
{
    use HasFactory;

    protected $table = 'data_program_remaja_masjid';

    protected $guarded = ['id'];

    // Relasi ke jenis program
    public function jenisProgram()
    {
        return $this->belongsTo(MdProgramTakmir::class, 'jenis_program_id');
    }

    // Relasi ke penanggung jawab
    public function dataInduk()
    {
        return $this->belongsTo(DataInduk::class, 'data_induk_id');
    }
}
