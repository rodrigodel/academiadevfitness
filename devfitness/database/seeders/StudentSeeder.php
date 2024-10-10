<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('students')->updateOrInsert(
            ['email' => 'carlos@alunodevfitness.com'], 
            [
                'name' => 'Carlos D.',
                'cpf' => '12345678901',
                'phone' => '12345678901',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        DB::table('students')->updateOrInsert(
            ['email' => 'gabriella@alunodevfitness.com'], 
            [
                'name' => 'Gabriella F.',
                'cpf' => '09876543210',
                'phone' => '09876543210',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );
    }
}
