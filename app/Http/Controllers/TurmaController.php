<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Exceptions\TurmaException;
use App\Services\TurmaServiceInterface;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class TurmaController extends Controller
{
    public function __construct(protected TurmaServiceInterface $turmaService) {}

    public function index(): JsonResponse
    {
        try {
            $turma = $this->turmaService->getAll();
            return response()->json($turma, Response::HTTP_OK);
        } catch (TurmaException $stException) {
            return response()->json(['message' => $stException->getMessage(), 'statusCode' => Response::HTTP_NOT_FOUND], Response::HTTP_NOT_FOUND);
        } catch (Throwable) {
            return response()->json(['message' => 'Ocorreu um Erro inesperado', 'statusCode' => Response::HTTP_INTERNAL_SERVER_ERROR], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
