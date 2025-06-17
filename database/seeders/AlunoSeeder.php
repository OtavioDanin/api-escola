<?php

namespace Database\Seeders;

use App\Models\Aluno;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class AlunoSeeder extends Seeder
{
    public function run()
    {
        for ($i = 0; $i <= 10; $i++) {
            Aluno::create([
                'id' => Str::orderedUuid(),
                'idTurma' => rand(1, 3),
                'idStatus' => rand(1, 3),
                'nome' => 'Aluno ' . $i,
                'cpf' => Str::padLeft(rand(1, 99999999999), 11, '0'),
                'data_nascimento' => now()->subYears(rand(10, 30)),
            ]);
        }
    }
}
