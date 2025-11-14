<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Marca;

class MarcasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $marcas = [
            ['nome' => 'BMW', 'pais_origem' => 'Alemanha', 'ativo' => true],
            ['nome' => 'BYD', 'pais_origem' => 'China', 'ativo' => true],
            ['nome' => 'Toyota', 'pais_origem' => 'Japão', 'ativo' => true],
            ['nome' => 'Renault', 'pais_origem' => 'França', 'ativo' => true],
            ['nome' => 'Peugeot', 'pais_origem' => 'França', 'ativo' => true],
            ['nome' => 'Chevrolet', 'pais_origem' => 'Estados Unidos', 'ativo' => true],
            ['nome' => 'Fiat', 'pais_origem' => 'Itália', 'ativo' => true],
            ['nome' => 'Ford', 'pais_origem' => 'Estados Unidos', 'ativo' => true],
        ];

        foreach ($marcas as $marca) {
            Marca::create($marca);
        }
    }
}
