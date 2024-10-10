<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Remove o código que cria o usuário de teste
        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // Chama os seeders que você deseja executar
        $this->call(MemberSeeder::class);
        $this->call(UserSeeder::class);
    }
}


