<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Status;
use Illuminate\Database\Eloquent\Collection;

class StatusRepository implements StatusRepositoryInterface
{
    public function __construct(protected Status $status) {}

    public function findById(int $idStatus): Status
    {
        return $this->status->findOrFail($idStatus);
    }

    public function update(int $id, array $statusRepository): ?bool
    {
        $status = $this->findById($id);
        return $status?->update($statusRepository);
    }

    public function findAll(): Collection
    {
        return $this->status::all();
    }
}
