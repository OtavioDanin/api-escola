<?php

declare(strict_types=1);

namespace App\Services;

interface StatusServiceInterface
{
    public function update(int $id, string $nomeStatus);
}
