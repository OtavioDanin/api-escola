<?php

declare(strict_types=1);

namespace App\Services;

interface AlunoServiceInterface
{
    public function save(array $data): void;
    public function update(int $id, array $livroData): void;

}