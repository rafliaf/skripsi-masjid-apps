<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgramTakmir extends Model
{
    use HasFactory;

    protected $table = 'data_program_takmir';

    protected $guarded = ['id'];

    // Relasi ke jenis program
    public function jenisProgram()
    {
        return $this->belongsTo(MdProgramTakmir::class, 'jenis_program_id');
    }

    // Relasi ke penanggung jawab data induk
    public function dataInduk()
    {
        return $this->belongsTo(DataInduk::class, 'data_induk_id');
    }

    
}
