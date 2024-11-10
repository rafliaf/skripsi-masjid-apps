<?php

namespace Database\Factories;

use App\Models\ProgramRemajaMasjid;
use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;

class ProgramRemajaMasjidFactory extends Factory
{
    protected $model = ProgramRemajaMasjid::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        // Set Faker to use Indonesian locale
        $this->faker->locale('id_ID');

        return [
            'masjid_id' => 1,
            'jenis_program_id' => $this->faker->randomElement(range(1, 2)),
            'data_induk_id' =>  $this->faker->randomElement(range(1, 54)),
            'nama_kegiatan' => $this->faker->sentence,
            'lokasi_kegiatan' => $this->faker->city . ', ' . $this->faker->state,
            'tgl_mulai' => Carbon::parse($this->faker->dateTimeBetween('-1 month', 'now'))->format('Y-m-d H:i:s'),
            'tgl_selesai' => Carbon::parse($this->faker->dateTimeBetween('now', '+1 month'))->format('Y-m-d H:i:s'),
            'sasaran_kegiatan' => $this->faker->sentence,
            'catatan_pelaksanaan' => $this->faker->optional()->paragraph,
        ];
    }
}
