<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Aluno extends Model
{
    use HasFactory;

    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'id',
        'idTurma',
        'idStatus',
        'nome',
        'cpf',
        'data_nascimento',
    ];

    protected $casts = [
        'data_nascimento' => 'date'
    ];

    public function status(): BelongsTo
    {
        return $this->belongsTo(Status::class, 'idStatus');
    }

    public function turma(): BelongsTo
    {
        return $this->belongsTo(Turma::class, 'idTurma');
    }
}
