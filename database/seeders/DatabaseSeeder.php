<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // admin
        User::updateOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name' => 'Admin',
                'nik' => '0000000000000001',
                'role' => 'Admin',
                'password' => Hash::make('123456'),
                'email_verified_at' => now(),
            ]
        );
        // ortu
        User::updateOrCreate(
            ['email' => 'ortu@gmail.com'],
            [
                'name' => 'Budi',
                'nik' => '0000000000000002',
                'role' => 'Orang Tua',
                'password' => Hash::make('123456'),
                'email_verified_at' => now(),
            ]
        );

        // $this->call(MpasiSeeder::class);
    }
}
