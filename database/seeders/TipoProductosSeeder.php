<?php

namespace Database\Seeders;

use App\Models\TipoProducto;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TipoProductosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TipoProducto::create([
            'tipo' => 'Tela',
            'descripcion' => 'El producto es Tela',
        ]);

        TipoProducto::create([
            'tipo' => 'Arreglo',
            'descripcion' => 'El producto es Arreglo',
        ]);
        TipoProducto::create([
            'tipo' => 'Merceria',
            'descripcion' => 'El producto no es Arreglo ni Tela',
        ]);
    }
}
