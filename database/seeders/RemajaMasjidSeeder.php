<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\RemajaMasjid;

class RemajaMasjidSeeder extends Seeder
{
    public function run()
    {
        // Buat 20 data remaja masjid
        RemajaMasjid::factory()->count(20)->create();
    }
}
