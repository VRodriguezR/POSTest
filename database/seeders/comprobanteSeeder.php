<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Comprobante;

class comprobanteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Comprobante::insert([
            [
                'tipo_comprobante' => 'Factura',
            ],
            [
                'tipo_comprobante' => 'Ticket',
            ]
        ]);
    }
}
