<?php

declare(strict_types=1);

namespace App\Services;

use App\Exceptions\AlunoException;
use App\Helpers\UniqueIdentifierInterface;
use App\Repositories\AlunoRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AlunoService implements AlunoServiceInterface
{
    public function __construct(
        protected AlunoRepositoryInterface $alunoRepository,
        protected UniqueIdentifierInterface $unique,
    ) {}

    public function save(array $alunoData): void
    {
        if (empty($alunoData)) {
            throw new AlunoException('Não existe aluno para ser inserido.', 500);
        }
        
        $alunoData['id'] = $this->unique->generate();

        DB::transaction(function () use ($alunoData) {
            $aluno =  $this->alunoRepository->persist($alunoData);
            $aluno->turmas()->attach($alunoData['idTurma']);
            $aluno->status()->attach($alunoData['idStatus']);
        });
    }

    public function update(int $id, array $alunoData): void
    {
        if (empty($alunoData)) {
            throw new AlunoException('Não há livros para atualizar.', 500);
        }
        DB::transaction(function () use ($id, $alunoData) {
            $aluno =  $this->alunoRepository->update($id, $alunoData);
            $aluno->turmas()->sync($alunoData['idTurma']);
            $aluno->status()->sync($alunoData['idStatus']);
        });
    }
}
