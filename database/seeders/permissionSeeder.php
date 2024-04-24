<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use \Spatie\Permission\Models\Permission;

class permissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permisos = [
            'ver-categoria',
            'crear-categoria',
            'editar-categoria',
            'eliminar-categoria',

            'ver-cliente',
            'crear-cliente',
            'editar-cliente',
            'eliminar-cliente',

            'ver-compra',
            'crear-compra',
            'mostrar-compra',
            'eliminar-compra',

            'ver-marca',
            'crear-marca',
            'editar-marca',
            'eliminar-marca',

            'ver-presentacione',
            'crear-presentacione',
            'editar-presentacione',
            'eliminar-presentacione',

            'ver-producto',
            'crear-producto',
            'editar-producto',
            'eliminar-producto',

            'ver-proveedore',
            'crear-proveedore',
            'editar-proveedore',
            'eliminar-proveedore',

            'ver-venta',
            'crear-venta',
            'mostrar-venta',
            'eliminar-venta',

            'ver-rol',
            'crear-rol',
            'editar-rol',
            'eliminar-rol',

            'ver-usuario',
            'crear-usuario',
            'editar-usuario',
            'eliminar-usuario',
        ];

        foreach ($permisos as $permiso) {
            Permission::create(['name' => $permiso]);
        }
    }
}
