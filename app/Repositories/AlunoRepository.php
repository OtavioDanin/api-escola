<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Aluno;

class AlunoRepository implements AlunoRepositoryInterface
{
    public function __construct(protected Aluno $aluno) {}

    public function persist(array $data): Aluno
    {
        return $this->aluno->create($data);
    }

    public function update(int $id, array $data): Aluno
    {
        $aluno = $this->findById($id);
        $aluno->update($data);
        return $aluno;
    }

    public function findById(int $id): ?Aluno
    {
        return $this->aluno::with(['turmas', 'status'])->find($id);
    }
}
