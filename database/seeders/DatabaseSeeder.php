<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(documentoSeeder::class);
        $this->call(comprobanteSeeder::class);
        $this->call(userSeeder::class);
        $this->call(permissionSeeder::class);
    }
}
