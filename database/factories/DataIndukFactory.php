<?php

namespace Database\Factories;

use App\Models\DataInduk;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Factory as FakerFactory;

class DataIndukFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = DataInduk::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $faker = FakerFactory::create('id_ID');

        return [
            'masjid_id' => 1,
            'kartu_keluarga_id' => $faker->numberBetween(1, 20), // Pastikan ID ini ada di data_kartu_keluarga
            'nik' => $faker->unique()->numerify('################'),
            'nama_lengkap' => $faker->name(),
            'status_hubungan_keluarga' => $faker->randomElement(['Kepala Keluarga', 'Istri', 'Anak', 'Orang Tua']),
            'tempat_lahir' => $faker->city(),
            'tgl_lahir' => $faker->date(),
            'jenis_kelamin' => $faker->randomElement(['perempuan']),
            'pendidikan' => $faker->randomElement(['belum_sekolah', 'paud', 'tk', 'sd', 'smp', 'smk', 'sma', 'd1', 'd2', 'd3', 'd4', 's1', 's2', 's3']),
            'pekerjaan' => $faker->randomElement([
                'Belum Bekerja',
                'Karyawan Honorer',
                'Wiraswasta',
                'Promotor Acara',
                'Arsitek',
                'Pedagang',
            ]),
            'no_wa' => $faker->unique()->numerify('08##########'),
            'status_kawin' => $faker->randomElement(['menikah', 'belum_menikah', 'duda', 'janda']),
            'is_remaja_masjid' => $faker->randomElement(['ya', 'tidak']),
            'is_status_mukim' => $faker->randomElement(['ya', 'tidak']),
            'is_baca_latin' => $faker->randomElement(['ya', 'tidak']),
            'is_baca_hijaiyah' => $faker->randomElement(['ya', 'tidak']),
            'is_baca_iqro' => $faker->randomElement(['ya', 'tidak']),
            'is_baca_quran' => $faker->randomElement(['ya', 'tidak']),
            'is_sholat_5_waktu' => $faker->randomElement(['ya', 'tidak']),
            'is_sholat_berjamaah' => $faker->randomElement(['ya', 'tidak']),
            'is_zakat_fitrah' => $faker->randomElement(['ya', 'tidak']),
            'is_zakat_mal' => $faker->randomElement(['ya', 'tidak']),
            'is_kurban' => $faker->randomElement(['ya', 'tidak']),
            'is_haji' => $faker->randomElement(['ya', 'tidak']),
            'is_umrah' => $faker->randomElement(['ya', 'tidak']),
            'is_pengajian_rutin' => $faker->randomElement(['ya', 'tidak']),
        ];
    }

    public function withTglLahir($date)
    {
        return $this->state(function (array $attributes) use ($date) {
            return [
                'tgl_lahir' => $date,
            ];
        });
    }
    // public function withPekerjaan()
    // {
    //     return $this->state(function (array $attributes) use ($date) {
    //         return [
    //             'pekerjaan' => $date,
    //         ];
    //     });
    // }
}
