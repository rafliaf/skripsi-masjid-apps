<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProgramTakmir;

class ProgramTakmirSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Seed data_program_takmir
        ProgramTakmir::factory(5)->create();
    }
}
