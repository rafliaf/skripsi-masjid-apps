<?php

namespace Database\Seeders;

use App\Models\ProgramRemajaMasjid;
use Illuminate\Database\Seeder;

class ProgramRemajaMasjidSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ProgramRemajaMasjid::factory()->count(10)->create();
    }
}
