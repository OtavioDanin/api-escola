<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\DTO\AlunoDTO;
use App\Exceptions\AlunoException;
use App\Services\AlunoServiceInterface;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
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
            $data = $this->alunoDto::from($request->all())->all();
            $this->alunoService->save($data);
            return response()->json(['message' => 'Aluno cadastrado com sucesso.', 'statusCode' => Response::HTTP_CREATED], Response::HTTP_CREATED);
        } catch (AlunoException $aluException) {
            return response()->json(['message' => $aluException->getMessage(), 'statusCode' => Response::HTTP_INTERNAL_SERVER_ERROR], Response::HTTP_INTERNAL_SERVER_ERROR);
        } catch (QueryException) {
            return response()->json(['message' => 'Falha ao salvar o Aluno, tente novamente em alguns instantes', 'statusCode' => Response::HTTP_BAD_REQUEST], Response::HTTP_BAD_REQUEST);
        } catch (Throwable) {
            return response()->json(['message' => 'Ocorreu um Erro inesperado', 'statusCode' => Response::HTTP_INTERNAL_SERVER_ERROR], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function update(Request $request, string $id)
    {
        try {
            $data = $this->alunoDto::from($request->all())->all();
            $this->alunoService->update($id, $data);
            return response()->json(['message' => 'Aluno cadastrado com sucesso.', 'statusCode' => Response::HTTP_OK], Response::HTTP_OK);
        } catch (AlunoException $aluException) {
            return response()->json(['message' => $aluException->getMessage(), 'statusCode' => Response::HTTP_NOT_FOUND], Response::HTTP_NOT_FOUND);
        } catch (QueryException) {
            return response()->json(['message' => 'Falha ao atualizar o Aluno, tente novamente em alguns instantes', 'statusCode' => Response::HTTP_BAD_REQUEST], Response::HTTP_BAD_REQUEST);
        } catch (Throwable) {
            return response()->json(['message' => 'Ocorreu um Erro inesperado', 'statusCode' => Response::HTTP_INTERNAL_SERVER_ERROR], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function index()
    {
        try {
            $alunos = $this->alunoService->getAll();
            return response()->json($alunos, Response::HTTP_OK);
        } catch (AlunoException $aluException) {
            return response()->json(['message' => $aluException->getMessage(), 'statusCode' => Response::HTTP_NOT_FOUND], Response::HTTP_NOT_FOUND);
        } catch (Throwable) {
            return response()->json(['message' => 'Ocorreu um Erro inesperado', 'statusCode' => Response::HTTP_INTERNAL_SERVER_ERROR], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }


    public function find(Request $request, string $id)
    {
        try {
            $aluno = $this->alunoService->findById($id);
            return response()->json($aluno, Response::HTTP_OK);
        } catch (AlunoException $aluException) {
            return response()->json(['message' => $aluException->getMessage(), 'statusCode' => Response::HTTP_NOT_FOUND], Response::HTTP_NOT_FOUND);
        } catch (Throwable) {
            return response()->json(['message' => 'Ocorreu um Erro inesperado.', 'statusCode' => Response::HTTP_INTERNAL_SERVER_ERROR], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
