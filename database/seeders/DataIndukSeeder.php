<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DataInduk;

class DataIndukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Generate 20 data induk dummy
        // DataInduk::factory()->count(20)->create();

        DataInduk::factory()
            ->count(5)
            ->withTglLahir('2019-05-11') // Semua data menggunakan tanggal 2000-05-15
            ->create();
    }
}
