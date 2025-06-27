<?php

declare(strict_types=1);

namespace App\Repositories;

interface StatusRepositoryInterface
{
    public function findById(int $idStatus);
    public function update(int $id, array $data);
    public function findAll();
}
