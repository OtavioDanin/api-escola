<?php

namespace Database\Seeders;

use App\Models\Turma;
use Illuminate\Database\Seeder;

class TurmaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Turma::create(['nome' => 'Turma Alfa']);
        Turma::create(['nome' => 'Turma Beta']);
        Turma::create(['nome' => 'Turma Gama']);
    }
}
