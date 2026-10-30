<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        //akun admin
        User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
            'name' => 'Admin User',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        //akun user biasa
        User::firstOrCreate(
            ['email' => 'user@example.com'],
            [
            'name' => 'User Biasa',
            'password' => Hash::make('12345'),
            'role' => 'user',
        ]);

        $this->call([
            PostTableSeeder::class,
        ]);
    }
}
