<?php

declare(strict_types=1);

namespace App\Services;

use App\Exceptions\AlunoException;
use App\Helpers\UniqueIdentifierInterface;
use App\Repositories\AlunoRepositoryInterface;
use App\Repositories\StatusRepositoryInterface;
use App\Repositories\TurmaRepositoryInterface;
use Illuminate\Support\Facades\DB;

class AlunoService implements AlunoServiceInterface
{
    public function __construct(
        protected AlunoRepositoryInterface $alunoRepository,
        protected TurmaRepositoryInterface $turmaRepository,
        protected StatusRepositoryInterface $statusRepository,
        protected UniqueIdentifierInterface $unique,
    ) {}

    public function save(array $alunoData): void
    {
        if (empty($alunoData)) {
            throw new AlunoException('Não existe aluno para ser inserido.', 400);
        }
        $alunoData['id'] = $this->unique->generate();
        $alunoData['data_nascimento'] = $alunoData['dataNascimento'];
        $alunoData['cpf'] = preg_replace('/[^0-9]/is', '', $alunoData['cpf']);

        $cpf = $this->alunoRepository->searchByParam(['cpf' => $alunoData['cpf']]);
        if (isset($cpf)) {
            throw new AlunoException('Existe um aluno com esse CPF.', 500);
        }
        DB::transaction(function () use ($alunoData) {
            $turma = $this->turmaRepository->findById($alunoData['idTurma']);
            $status = $this->statusRepository->findById($alunoData['idStatus']);
            $aluno =  $this->alunoRepository->persist($alunoData);
            $aluno->turmas()->associate($turma);
            $aluno->status()->associate($status);
        });
    }

    public function update(string $id, array $alunoData): void
    {
        if (empty($alunoData)) {
            throw new AlunoException('Não há aluno para atualizar.', 404);
        }
        $alunoData = array_filter($alunoData, fn($value) => $value !== null);
        $alunoData['cpf'] = preg_replace('/[^0-9]/is', '', $alunoData['cpf']);
        if (isset($alunoData['idStatus'])) {
            unset($alunoData['idStatus']);
        }

        DB::transaction(function () use ($id, $alunoData) {
            $aluno =  $this->alunoRepository->update($id, $alunoData);
            if(!isset($aluno)){
                throw new AlunoException('Aluno não encontrado para atualizar.', 404);
            }
            $aluno->turmas()->associate($alunoData['idTurma']);
        });
    }

    public function getAll(): array
    {
        $alunos = $this->alunoRepository->findAll();
        if ($alunos->isEmpty()) {
            throw new AlunoException('Não existem alunos cadastrados.', 404);
        }
        return $alunos->toArray();
    }

    public function findById(string $id): array
    {
        $aluno = $this->alunoRepository->searchListAluno(['id' => $id], true);
        if (!isset($aluno)) {
            throw new AlunoException('Aluno não encontrado.', 404);
        }
        return (array) $aluno;
    }
}
