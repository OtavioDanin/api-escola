<?php

declare(strict_types=1);

namespace App\Services;

interface AlunoServiceInterface
{
    public function save(array $data): void;
    public function update(string $id, array $livroData): void;
    public function getAll();
    public function findById(string $id);
}
