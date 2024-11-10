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
            'masjid_id' => 2, // Hardcoded masjid_id
            'data_induk_id' => $this->faker->randomElement(range(58, 98)), // Relasi ke DataInduk
            'kartu_keluarga_id' => $this->faker->randomElement(range(21, 40)), // Relasi ke DataKartuKeluarga
            'is_remaja_masjid' => $this->faker->randomElement(['ya', 'tidak']), // Status remaja masjid
        ];
    }
}
