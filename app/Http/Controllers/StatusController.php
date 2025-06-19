<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Exceptions\StatusException;
use App\Services\StatusServiceInterface;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class StatusController extends Controller
{
    public function __construct(
        protected StatusServiceInterface $statusService,
    ) {}

    public function update(Request $request, int $id)
    {
        try {
            $this->statusService->update($id, $request->input('nome'));
            return response()->json(['message' => 'Status atualizado com sucesso.', 'statusCode' => Response::HTTP_OK], Response::HTTP_OK);
        } catch (StatusException $aluException) {
            return response()->json(['message' => $aluException->getMessage(), 'statusCode' => Response::HTTP_FORBIDDEN], Response::HTTP_FORBIDDEN);
        } catch (QueryException) {
            return response()->json(['message' => 'Falha ao atualizar o Aluno, tente novamente em alguns instantes', 'statusCode' => Response::HTTP_BAD_REQUEST], Response::HTTP_BAD_REQUEST);
        } catch (Throwable) {
            return response()->json(['message' => 'Ocorreu um Erro inesperado', 'statusCode' => Response::HTTP_INTERNAL_SERVER_ERROR], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
