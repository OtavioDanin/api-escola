<?php

declare(strict_types=1);

namespace App\Services;

use App\Exceptions\StatusException;
use App\Repositories\StatusRepositoryInterface;

class StatusService implements StatusServiceInterface
{
    public function __construct(protected StatusRepositoryInterface $statusRepository) {}

    public function update(int $id, string $nomeStatus): void
    {
        if ($nomeStatus === '') {
            throw new StatusException('Dados vazios enviados na Atualização.');
        }
        $arrayStatus = [2, 3];
        if(!in_array($id, $arrayStatus)){
            throw new StatusException('A atualização é permitida apenas para os status Aprovado ou Cancelado.', 403);
        }
        $hasUpdate = $this->statusRepository->update($id, ['nome' => $nomeStatus]);
        if (!$hasUpdate) {
            throw new StatusException('Falha ao atualizar o status.');
        }
    }
}
