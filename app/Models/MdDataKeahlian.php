<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MdDataKeahlian extends Model
{
    use HasFactory;

    // If your table name doesn't follow Laravel's convention (plural form of the model name),
    // specify the table name explicitly
    protected $table = 'md_data_keahlian';

    // If you don't use mass assignment for certain fields, this prevents errors
    protected $guarded = ['id'];

    // Disable automatic timestamps
    public $timestamps = false;

    /**
     * The mosque that owns this skill type.
     */
    public function mosque()
    {
        return $this->belongsTo(RegisterMasjid::class, 'masjid_id');
    }

    /**
     * The skills (data_keahlian) that use this skill type.
     */
    public function skills()
    {
        return $this->hasMany(DataKeahlian::class, 'jenis_keahlian_id');
    }
}
