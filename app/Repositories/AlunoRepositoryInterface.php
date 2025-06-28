<?php

declare(strict_types=1);

namespace App\Repositories;

interface AlunoRepositoryInterface
{
    public function persist(array $data);
    public function update(string $id, array $data);
    public function findById(string $id);
    public function searchByParam(array $param): ?object;
    public function findAll();
    public function searchListAluno(array $param): ?object;
    public function delete(string $id);
}
