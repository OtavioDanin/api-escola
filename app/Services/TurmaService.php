<?php

declare(strict_types=1);

namespace App\Services;

use App\Exceptions\TurmaException;
use App\Repositories\TurmaRepositoryInterface;

class TurmaService implements TurmaServiceInterface
{
    public function __construct(protected TurmaRepositoryInterface $turmaRepository) {}

    public function getAll(): array
    {
        $turma = $this->turmaRepository->findAll();
        if ($turma->isEmpty()) {
            throw new TurmaException('Não existem turmas cadastrados.', 404);
        }
        return $turma->toArray();
    }
}
