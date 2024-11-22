<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Admin::create([
            'nama' => 'Admin',
            'id_penyewa' => 1,
            'username' => 'admin',
            'password' => bcrypt('password'),
            'role' => 'admin'
        ]);

        Admin::create([
            'nama' => 'Super Admin',
            'username' => 'super',
            'password' => bcrypt('password'),
            'role' => 'superadmin'
        ]);

    }
}
