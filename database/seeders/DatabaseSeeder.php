<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     *
     * As credenciais do administrador inicial vêm de variáveis de ambiente
     * (ADMIN_EMAIL / ADMIN_PASSWORD). Em desenvolvimento, defina no .env.
     */
    public function run(): void
    {
        $adminEmail = env('ADMIN_EMAIL', 'admin@example.local');
        $adminPassword = env('ADMIN_PASSWORD');

        if (empty($adminPassword)) {
            $this->command?->warn(
                'ADMIN_PASSWORD não definida no .env — pulando criação do usuário admin.'
            );
        } else {
            User::updateOrCreate(
                ['email' => $adminEmail],
                [
                    'name' => env('ADMIN_NAME', 'Administrador'),
                    'password' => Hash::make($adminPassword),
                    'is_admin' => true,
                ]
            );
        }

        // Popular dados na ordem correta (devido às foreign keys)
        $this->call([
            MarcasSeeder::class,
            CoresSeeder::class,
            ModelosSeeder::class,  // Depende de Marcas
            VeiculosSeeder::class, // Depende de Marcas, Modelos e Cores
        ]);
    }
}
