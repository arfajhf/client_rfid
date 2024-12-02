<?php

namespace Database\Factories;

use App\Models\DataSdm;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DataPresensi>
 */
class DataPresensiFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id_sdm' => DataSdm::inRandomOrder()->first()->id,
            'jam_masuk' => $this->faker->time('H:i:s'),
            'jam_keluar' => $this->faker->time('H:i:s'),
            'setatus' => $this->faker->randomElement(['in', 'out']),
            'keterangan' => $this->faker->randomElement(['hadir']),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
