<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Aluno;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class AlunoRepository implements AlunoRepositoryInterface
{
    private const TABLE = 'alunos';

    public function __construct(protected Aluno $aluno) {}

    public function persist(array $data): Aluno
    {
        return $this->aluno->create($data);
    }

    public function update(string $id, array $data): ?Aluno
    {
        $aluno = $this->findById($id);
        $aluno?->update($data);
        return $aluno;
    }

    public function findById(string $id): ?Aluno
    {
        return $this->aluno::with(['turmas', 'status'])->find($id);
    }

    public function searchByParam(array $param, bool $allColumns = false): ?object
    {
        $current = current($param);
        $keyColumn = $allColumns ? ['*'] : key($param);

        $query = DB::table(self::TABLE);
        $query->where(key($param), $current);
        return $query->first($keyColumn);
    }

    public function searchListAluno(array $param, bool $allColumns = false): ?object
    {
        $current = current($param);
        $keyColumns = ['alunos.nome', 'cpf', 'data_nascimento', 'turmas.id as idTurma', 'turmas.nome as nomeTurma', 'status.id as idStatus', 'status.nome as nomeStatus'];

        $query = DB::table(self::TABLE);
        $query->where('alunos.' . key($param), '=', $current);
        $query->join('turmas', 'alunos.idTurma', '=', 'turmas.id');
        $query->join('status', 'alunos.idStatus', '=', 'status.id');
        return $query->first($keyColumns);
    }

    public function findAll(): Collection
    {
        return $this->aluno->orderBy('created_at', 'desc')->get();
    }
}
