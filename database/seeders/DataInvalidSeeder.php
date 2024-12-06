<?php

namespace Database\Seeders;

use App\Models\DataInvalid;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DataInvalidSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DataInvalid::create([
            'uid' => '2345770',
        ]);
    }
}
