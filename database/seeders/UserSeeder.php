<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class UserSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'rol_id' => 1,
            'estadoUsuario' => 1,
            'nombre' => 'Administrador',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
        ]);

        User::create([
            'rol_id' => 2,
            'estadoUsuario' => 1,
            'nombre' => 'Usuario',
            'email' => 'user@example.com',
            'password' => Hash::make('password'),
        ]);
    }
}
