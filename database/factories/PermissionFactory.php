<?php

namespace Database\Factories;


use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Permission>
 */
class PermissionFactory extends Factory
{
    public function definition(): array
    {
        static $index = 0;

        $permissions = [
            ['name' => 'Panel de cocina', 'category' => 'cocina'],
            ['name' => 'Acciones de cocina', 'category' => 'cocina'],
            ['name' => 'Permisos de administrador', 'category' => 'admin'],
            ['name' => 'Gestion de usuarios', 'category' => 'admin'],
            ['name' => 'Atencion de mesas', 'category' => 'mozo'],
            ['name' => 'Registro de pedidos', 'category' => 'mozo'],
            ['name' => 'Apertura y cierre de caja', 'category' => 'caja'],
            ['name' => 'Administrador de ordenes', 'category' => 'caja'],
        ];

        $p = $permissions[$index];
        $index++;

        return [
            'name' => $p['name'],
            'category' => $p['category'],
        ];
    }
}
