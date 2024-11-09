<?php

namespace Database\Factories;

use App\Models\DataKartuKeluarga;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Factory as FakerFactory;

class DataKartuKeluargaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = DataKartuKeluarga::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        // Buat instance faker dengan locale Indonesia
        $faker = FakerFactory::create('id_ID');

        return [
            'nomor_kk' => $faker->unique()->numerify('################'), // Nomor KK 16 digit
            'no_rt' => $faker->numerify('RT ##'), // Nomor RT
            'nama_kepala_keluarga' => $faker->firstNameMale . ' ' . $faker->lastName, // Nama laki-laki Indonesia
            'kode_rumah' => $faker->unique()->bothify('A-##'), // Kode rumah
            'level_ekonomi' => $faker->randomElement(['menengah_ke_atas', 'menengah', 'menengah_ke_bawah']),
            'jumlah_anggota_keluarga' => $faker->numberBetween(1, 5),
            'no_wa' => $faker->unique()->numerify('08##########'), // Nomor WhatsApp
            'keterangan' => $faker->optional()->sentence(), // Keterangan opsional
        ];
    }

    /**
     * Custom state for masjid_id.
     *
     * @param int $masjidId
     * @return static
     */
    public function withMasjidId($masjidId)
    {
        return $this->state(function (array $attributes) use ($masjidId) {
            return [
                'masjid_id' => $masjidId,
            ];
        });
    }
}
