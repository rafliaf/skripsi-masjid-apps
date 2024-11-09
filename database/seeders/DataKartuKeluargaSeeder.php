<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DataKartuKeluarga;
use Illuminate\Support\Facades\Auth;

class DataKartuKeluargaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Masjid_id di-hardcode sebagai 1
        $masjidId = 1;

        // Buat data dummy dengan masjid_id 1
        DataKartuKeluarga::factory()->count(20)->withMasjidId($masjidId)->create();
    }
}
