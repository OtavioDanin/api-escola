<?php

declare(strict_types=1);

namespace App\Repositories;

interface TurmaRepositoryInterface
{
    public function findById(int $idTurma);
    public function update(int $id, array $data): bool;
}
