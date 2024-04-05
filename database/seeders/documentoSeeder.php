<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Documento;
use Illuminate\Database\Seeder;

class documentoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Documento::insert([
            ['tipo_documento' => 'INE'],
            ['tipo_documento' => 'LICENCIA DE CONDUCIR'],
            ['tipo_documento' => 'PASAPORTE'],
            ['tipo_documento' => 'CEDULA PROFESIONAL'],
        ]);
    }
}
