<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Modelo;
use App\Models\Marca;

class ModelosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $bmw = Marca::where('nome', 'BMW')->first();
        $byd = Marca::where('nome', 'BYD')->first();
        $toyota = Marca::where('nome', 'Toyota')->first();
        $renault = Marca::where('nome', 'Renault')->first();
        $peugeot = Marca::where('nome', 'Peugeot')->first();
        $chevrolet = Marca::where('nome', 'Chevrolet')->first();
        $fiat = Marca::where('nome', 'Fiat')->first();
        $ford = Marca::where('nome', 'Ford')->first();

        $modelos = [
            ['marca_id' => $bmw->id, 'nome' => 'M4', 'tipo' => 'Esportivo', 'ativo' => true],
            ['marca_id' => $bmw->id, 'nome' => 'X5', 'tipo' => 'SUV', 'ativo' => true],
            ['marca_id' => $byd->id, 'nome' => 'Dolphin', 'tipo' => 'Hatchback', 'ativo' => true],
            ['marca_id' => $byd->id, 'nome' => 'Seal', 'tipo' => 'Sedan', 'ativo' => true],
            ['marca_id' => $toyota->id, 'nome' => 'Corolla', 'tipo' => 'Sedan', 'ativo' => true],
            ['marca_id' => $toyota->id, 'nome' => 'SW4', 'tipo' => 'SUV', 'ativo' => true],
            ['marca_id' => $renault->id, 'nome' => 'Kwid', 'tipo' => 'Hatchback', 'ativo' => true],
            ['marca_id' => $renault->id, 'nome' => 'Duster', 'tipo' => 'SUV', 'ativo' => true],
            ['marca_id' => $peugeot->id, 'nome' => '208', 'tipo' => 'Hatchback', 'ativo' => true],
            ['marca_id' => $peugeot->id, 'nome' => '3008', 'tipo' => 'SUV', 'ativo' => true],
            ['marca_id' => $chevrolet->id, 'nome' => 'Onix', 'tipo' => 'Hatchback', 'ativo' => true],
            ['marca_id' => $chevrolet->id, 'nome' => 'Tracker', 'tipo' => 'SUV', 'ativo' => true],
            ['marca_id' => $fiat->id, 'nome' => 'Argo', 'tipo' => 'Hatchback', 'ativo' => true],
            ['marca_id' => $fiat->id, 'nome' => 'Toro', 'tipo' => 'Picape', 'ativo' => true],
            ['marca_id' => $ford->id, 'nome' => 'Ranger', 'tipo' => 'Picape', 'ativo' => true],
            ['marca_id' => $ford->id, 'nome' => 'Territory', 'tipo' => 'SUV', 'ativo' => true],
        ];

        foreach ($modelos as $modelo) {
            Modelo::create($modelo);
        }
    }
}
