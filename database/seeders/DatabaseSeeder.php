<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        if (! app()->environment(['local', 'testing'])) {
            $this->command?->warn('Akun demo hanya dibuat pada lingkungan local/testing.');

            return;
        }

        // admin
        User::firstOrCreate(
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
        User::firstOrCreate(
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
