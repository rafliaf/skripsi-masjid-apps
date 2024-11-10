<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DataKeahlian;

class DataKeahlianSeeder extends Seeder
{
    public function run()
    {
        // Buat data keahlian terkait data induk dan jenis keahlian
        DataKeahlian::factory()->count(15)->create();
    }
}
