<?php

namespace Database\Factories;

use App\Models\DataKeahlian;
use App\Models\DataInduk;
use App\Models\MdDataKeahlian;
use Illuminate\Database\Eloquent\Factories\Factory;

class DataKeahlianFactory extends Factory
{
    protected $model = DataKeahlian::class;

    public function definition()
    {
        return [
            'masjid_id' => 2, // Hardcoded masjid_id
            'jenis_keahlian_id' => $this->faker->randomElement(range(4, 5)),
            'data_induk_id' => $this->faker->randomElement(range(58, 98)),
            'keahlian_lain' => $this->faker->optional()->randomElement([
                'Menjahit',
                'Membordir',
                'Merangkai Bunga',
                'Bermain Alat Musik',
                'Menyulam',
                'Melukis'
            ]),
            'deskripsi_keahlian' => $this->faker->optional()->sentence(5), // Opsional deskripsi keahlian
            'is_sertifikat' => $this->faker->randomElement(['ya', 'tidak']),
            'deskripsi_sertifikat' => $this->faker->optional()->sentence(5), // Opsional deskripsi sertifikat
        ];
    }
}
