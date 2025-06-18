<?php

declare(strict_types=1);

namespace App\Repositories;

interface AlunoRepositoryInterface
{
    public function persist(array $data);
    public function update(int $id, array $data);
}
