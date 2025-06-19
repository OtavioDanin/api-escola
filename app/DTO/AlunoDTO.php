<?php

declare(strict_types=1);

namespace App\DTO;

use Spatie\LaravelData\Data;

class AlunoDTO extends Data
{
    public ?string $nome;
    public ?string $cpf;
    public ?string $dataNascimento;
    public ?int $idTurma;
    public ?int $idStatus;
}
