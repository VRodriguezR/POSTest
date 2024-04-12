<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class userSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::insert([
            [
                'name' => 'Admin',
                'email' => 'admin@admin.com',
                'password' => bcrypt('admin'),
            ],
            [
                'name' => 'User',
                'email' => 'user@user.com',
                'password' => bcrypt('12345'),
            ]
        ]);
    }
}
