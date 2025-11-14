<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Cor;

class CoresSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cores = [
            ['nome' => 'Preto', 'codigo_hex' => '#000000', 'ativo' => true],
            ['nome' => 'Branco', 'codigo_hex' => '#FFFFFF', 'ativo' => true],
            ['nome' => 'Prata', 'codigo_hex' => '#C0C0C0', 'ativo' => true],
            ['nome' => 'Cinza', 'codigo_hex' => '#808080', 'ativo' => true],
            ['nome' => 'Vermelho', 'codigo_hex' => '#FF0000', 'ativo' => true],
            ['nome' => 'Azul', 'codigo_hex' => '#0000FF', 'ativo' => true],
            ['nome' => 'Verde', 'codigo_hex' => '#00FF00', 'ativo' => true],
            ['nome' => 'Amarelo', 'codigo_hex' => '#FFFF00', 'ativo' => true],
            ['nome' => 'Dourado', 'codigo_hex' => '#FFD700', 'ativo' => true],
            ['nome' => 'Bege', 'codigo_hex' => '#F5F5DC', 'ativo' => true],
        ];

        foreach ($cores as $cor) {
            Cor::create($cor);
        }
    }
}
