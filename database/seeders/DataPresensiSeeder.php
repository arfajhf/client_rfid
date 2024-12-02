<?php

namespace Database\Seeders;

use App\Models\DataPresensi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DataPresensiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DataPresensi::factory()->count(3)->create();
    }
}
