<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\DTO\AlunoDTO;
use App\Services\AlunoServiceInterface;
use Illuminate\Http\Request;
use Throwable;

class AlunoController extends Controller
{
    public function __construct(
        protected AlunoServiceInterface $alunoService,
        protected AlunoDTO $alunoDto
    ) {}

    public function store(Request $request)
    {
        try {
            $data = $this->alunoDto::from($request->all());
            dd($data);
            $this->alunoService->save($request->all());
        } catch (Throwable $th) {
            dd($th->getMessage());
        }
    }
}
