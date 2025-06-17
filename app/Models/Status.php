<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Status extends Model
{
    protected $fillable = ['nome'];

    protected $table = 'status';

    public function alunos(): HasMany
    {
        return $this->hasMany(Aluno::class, 'idStatus', 'id');
    }
}
