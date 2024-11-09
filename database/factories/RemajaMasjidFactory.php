<?php

namespace Database\Factories;

use App\Models\RemajaMasjid;
use App\Models\DataInduk;
use App\Models\DataKartuKeluarga;
use Illuminate\Database\Eloquent\Factories\Factory;

class RemajaMasjidFactory extends Factory
{
    protected $model = RemajaMasjid::class;

    public function definition()
    {
        return [
            'masjid_id' => 1, // Hardcoded masjid_id
            'data_induk_id' => DataInduk::inRandomOrder()->first()->id, // Relasi ke DataInduk
            'kartu_keluarga_id' => DataKartuKeluarga::inRandomOrder()->first()->id, // Relasi ke DataKartuKeluarga
            'is_remaja_masjid' => $this->faker->randomElement(['ya', 'tidak']), // Status remaja masjid
        ];
    }
}
