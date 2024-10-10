<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('members')->updateOrInsert(
            ['email' => 'carlos@alunodevfitness.com'], 
            [
                'name' => 'Carlos D.',
                'cpf' => '12345678901',
                'phone' => '12345678901',
                'date_of_birth' => '1990-05-15',
                'gender' => 'male',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        DB::table('members')->updateOrInsert(
            ['email' => 'gabriella@alunodevfitness.com'], 
            [
                'name' => 'Gabriella F.',
                'cpf' => '09876543210',
                'phone' => '09876543210',
                'date_of_birth' => '1992-08-22',
                'gender' => 'female',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        DB::table('members')->updateOrInsert(
            ['email' => 'roberto@alunodevfitness.com'], 
            [
                'name' => 'Roberto G.',
                'cpf' => '22334455667',
                'phone' => '99912345678',
                'date_of_birth' => '1985-02-10',
                'gender' => 'male',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        DB::table('members')->updateOrInsert(
            ['email' => 'juliana@alunodevfitness.com'], 
            [
                'name' => 'Juliana K.',
                'cpf' => '33445566778',
                'phone' => '99987654321',
                'date_of_birth' => '1994-11-30',
                'gender' => 'female',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        DB::table('members')->updateOrInsert(
            ['email' => 'michael@alunodevfitness.com'], 
            [
                'name' => 'Michael T.',
                'cpf' => '44556677889',
                'phone' => '98765432100',
                'date_of_birth' => '1989-07-25',
                'gender' => 'male',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        DB::table('members')->updateOrInsert(
            ['email' => 'alessandra@alunodevfitness.com'], 
            [
                'name' => 'Alessandra M.',
                'cpf' => '55667788990',
                'phone' => '99887766554',
                'date_of_birth' => '1993-04-05',
                'gender' => 'female',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        DB::table('members')->updateOrInsert(
            ['email' => 'thiago@alunodevfitness.com'], 
            [
                'name' => 'Thiago L.',
                'cpf' => '66778899001',
                'phone' => '98712345678',
                'date_of_birth' => '1987-12-15',
                'gender' => 'male',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );
    }
}


