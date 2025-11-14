<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Criar usuário admin
        User::factory()->create([
            'name' => 'Administrador',
            'email' => 'admin@autoprime.com',
            'password' => bcrypt('admin123'),
        ]);

        // Popular dados na ordem correta (devido às foreign keys)
        $this->call([
            MarcasSeeder::class,
            CoresSeeder::class,
            ModelosSeeder::class,  // Depende de Marcas
            VeiculosSeeder::class, // Depende de Marcas, Modelos e Cores
        ]);
    }
}
