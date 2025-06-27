<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Turma;
use Illuminate\Database\Eloquent\Collection;

class TurmaRepository implements TurmaRepositoryInterface
{
    public function __construct(protected Turma $turma) {}

    public function findById(int $idTurma): Turma
    {
        return $this->turma->findOrFail($idTurma);
    }

    public function update(int $id, array $data): bool
    {
        $turma = $this->findById($id);
        return $this->turma->updateOrFail();
    }

    public function findAll(): Collection
    {
        return $this->turma::all();
    }
}
