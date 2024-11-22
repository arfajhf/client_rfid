<?php

namespace Database\Seeders;

use App\Models\DataPenyewa;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DataPenyewaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DataPenyewa::create([
            'nama' => 'SMK Negeri 1 Padalengan',
            'harga' => 100000,
            'status' => 'aktif'
        ]);
    }
}
