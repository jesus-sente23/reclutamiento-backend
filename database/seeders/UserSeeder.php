<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $usuarios = [
            [
                'name' => 'Administrador',
                'email' => 'admin@prueba.com',
            ],
            [
                'name' => 'Recursos Humanos',
                'email' => 'rrhh@prueba.com',
            ],
            [
                'name' => 'Jefe de Departamento',
                'email' => 'jefe@prueba.com',
            ],
        ];

        foreach ($usuarios as $usuario) {
            User::firstOrCreate(
                ['email' => $usuario['email']],
                [
                    'name' => $usuario['name'],
                    'password' => Hash::make('prueba2026'),
                    'email_verified_at' => now(),
                ]
            );
        }
    }
}
