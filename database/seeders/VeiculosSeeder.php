<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Veiculo;
use App\Models\Marca;
use App\Models\Modelo;
use App\Models\Cor;

class VeiculosSeeder extends Seeder
{
    public function run(): void
    {
        $bmw = Marca::where('nome', 'BMW')->first();
        $toyota = Marca::where('nome', 'Toyota')->first();
        $chevrolet = Marca::where('nome', 'Chevrolet')->first();
        $ford = Marca::where('nome', 'Ford')->first();
        $byd = Marca::where('nome', 'BYD')->first();
        $renault = Marca::where('nome', 'Renault')->first();
        
        $m4 = Modelo::where('nome', 'M4')->where('marca_id', $bmw->id)->first();
        $corolla = Modelo::where('nome', 'Corolla')->where('marca_id', $toyota->id)->first();
        $onix = Modelo::where('nome', 'Onix')->where('marca_id', $chevrolet->id)->first();
        $ranger = Modelo::where('nome', 'Ranger')->where('marca_id', $ford->id)->first();
        $seal = Modelo::where('nome', 'Seal')->where('marca_id', $byd->id)->first();
        $kwid = Modelo::where('nome', 'Kwid')->where('marca_id', $renault->id)->first();
        
        $preto = Cor::where('nome', 'Preto')->first();
        $branco = Cor::where('nome', 'Branco')->first();
        $prata = Cor::where('nome', 'Prata')->first();
        $azul = Cor::where('nome', 'Azul')->first();
        $vermelho = Cor::where('nome', 'Vermelho')->first();
        $cinza = Cor::where('nome', 'Cinza')->first();
        
        $veiculos = [
            [
                'marca_id' => $bmw->id, 
                'modelo_id' => $m4->id, 
                'cor_id' => $azul->id,
                'ano_fabricacao' => 2023, 
                'ano_modelo' => 2024, 
                'placa' => 'ABC1D23',
                'tipo' => 'Esportivo', 
                'quilometragem' => 5000, 
                'combustivel' => 'Gasolina',
                'cambio' => 'Automático', 
                'portas' => 2, 
                'motor' => '3.0 Turbo',
                'preco_compra' => 450000.00, 
                'preco_venda' => 520000.00,
                'status' => 'Disponível', 
                'categoria' => 'Seminovo',
                'descricao' => 'BMW M4 Competition em estado impecável. Carro esportivo de alta performance com motor 3.0 biturbo, tração traseira e câmbio automático de 8 marchas.',
                'chassi' => '9BMWX1234567890AB',
                'renavam' => '12345678901',
                'foto1' => 'https://images.unsplash.com/photo-1555215695-3004980ad54e?w=800',
                'observacoes' => 'Veículo em excelente estado, revisões em dia.',
                'data_aquisicao' => now()->subDays(30),
            ],
            [
                'marca_id' => $toyota->id, 
                'modelo_id' => $corolla->id, 
                'cor_id' => $prata->id,
                'ano_fabricacao' => 2022, 
                'ano_modelo' => 2023, 
                'placa' => 'DEF4E56',
                'tipo' => 'Sedan', 
                'quilometragem' => 15000, 
                'combustivel' => 'Flex',
                'cambio' => 'Automático', 
                'portas' => 4, 
                'motor' => '2.0 16V',
                'preco_compra' => 85000.00, 
                'preco_venda' => 98000.00,
                'status' => 'Disponível', 
                'categoria' => 'Seminovo',
                'descricao' => 'Toyota Corolla XEi, único dono. Sedan familiar com excelente custo-benefício e baixo consumo.',
                'chassi' => '9BRTC2345678901BC',
                'renavam' => '23456789012',
                'foto1' => 'https://images.unsplash.com/photo-1621007947382-bb3c3994e3fb?w=800',
                'observacoes' => 'Único dono, manual e chave reserva.',
                'data_aquisicao' => now()->subDays(45),
            ],
            [
                'marca_id' => $chevrolet->id, 
                'modelo_id' => $onix->id, 
                'cor_id' => $branco->id,
                'ano_fabricacao' => 2023, 
                'ano_modelo' => 2024, 
                'placa' => 'GHI7J89',
                'tipo' => 'Hatchback', 
                'quilometragem' => 8000, 
                'combustivel' => 'Flex',
                'cambio' => 'Automático', 
                'portas' => 4, 
                'motor' => '1.0 Turbo',
                'preco_compra' => 62000.00, 
                'preco_venda' => 72000.00,
                'status' => 'Disponível', 
                'categoria' => 'Seminovo',
                'descricao' => 'Chevrolet Onix Plus Turbo. Hatchback moderno e econômico, ideal para o dia a dia.',
                'chassi' => '9BRGM3456789012CD',
                'renavam' => '34567890123',
                'foto1' => 'https://images.unsplash.com/photo-1617654112368-307921291f42?w=800',
                'observacoes' => 'Veículo seminovo com garantia de fábrica.',
                'data_aquisicao' => now()->subDays(15),
            ],
            [
                'marca_id' => $ford->id, 
                'modelo_id' => $ranger->id, 
                'cor_id' => $preto->id,
                'ano_fabricacao' => 2022, 
                'ano_modelo' => 2023, 
                'placa' => 'JKL0M12',
                'tipo' => 'Picape', 
                'quilometragem' => 25000, 
                'combustivel' => 'Diesel',
                'cambio' => 'Automático', 
                'portas' => 4, 
                'motor' => '3.0 V6 Diesel',
                'preco_compra' => 220000.00, 
                'preco_venda' => 250000.00,
                'status' => 'Disponível', 
                'categoria' => 'Seminovo',
                'descricao' => 'Ford Ranger Storm 4x4. Picape robusta com tração 4x4 e motor diesel potente.',
                'chassi' => '9BRFR4567890123DE',
                'renavam' => '45678901234',
                'foto1' => 'https://images.unsplash.com/photo-1519641471654-76ce0107ad1b?w=800',
                'observacoes' => 'Tração 4x4, ideal para trabalho e aventura.',
                'data_aquisicao' => now()->subDays(60),
            ],
            [
                'marca_id' => $byd->id, 
                'modelo_id' => $seal->id, 
                'cor_id' => $vermelho->id,
                'ano_fabricacao' => 2024, 
                'ano_modelo' => 2024, 
                'placa' => null,
                'tipo' => 'Sedan', 
                'quilometragem' => 0, 
                'combustivel' => 'Elétrico',
                'cambio' => 'Automático', 
                'portas' => 4, 
                'motor' => 'Elétrico 530cv',
                'preco_compra' => 280000.00, 
                'preco_venda' => 320000.00,
                'status' => 'Disponível', 
                'categoria' => 'Novo',
                'descricao' => 'BYD Seal Performance elétrico. Sedan elétrico de alta performance com autonomia superior.',
                'chassi' => '9BRBP5678901234EF',
                'renavam' => null,
                'foto1' => 'https://images.unsplash.com/photo-1560958089-b8a1929cea89?w=800',
                'observacoes' => 'Veículo 0km, tecnologia elétrica de ponta.',
                'data_aquisicao' => now()->subDays(5),
            ],
            [
                'marca_id' => $renault->id, 
                'modelo_id' => $kwid->id, 
                'cor_id' => $cinza->id,
                'ano_fabricacao' => 2021, 
                'ano_modelo' => 2022, 
                'placa' => 'MNO3P45',
                'tipo' => 'Hatchback', 
                'quilometragem' => 35000, 
                'combustivel' => 'Flex',
                'cambio' => 'Manual', 
                'portas' => 4, 
                'motor' => '1.0 12V',
                'preco_compra' => 38000.00, 
                'preco_venda' => 45000.00,
                'status' => 'Disponível', 
                'categoria' => 'Usado',
                'descricao' => 'Renault Kwid Zen econômico. Hatchback compacto e econômico, perfeito para cidade.',
                'chassi' => '9BRRK6789012345FG',
                'renavam' => '56789012345',
                'foto1' => 'https://images.unsplash.com/photo-1552519507-da3b142c6e3d?w=800',
                'observacoes' => 'Carro econômico, ideal para primeiro veículo.',
                'data_aquisicao' => now()->subDays(90),
            ],
        ];
        
        foreach ($veiculos as $veiculo) {
            Veiculo::create($veiculo);
        }
    }
}
