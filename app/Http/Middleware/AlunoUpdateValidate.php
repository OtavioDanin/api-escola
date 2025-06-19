<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use InvalidArgumentException;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class AlunoUpdateValidate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        try {
            $data = $request->all();
            $this->validateData($data);
        } catch (InvalidArgumentException $invException) {
            return response()->json(['message' => $invException->getMessage(), 'statusCode' => $invException->getCode()], $invException->getCode());
        }
        return $next($request);
    }

    private function validateData(array $data): void
    {
         if (empty($data)) {
            throw new InvalidArgumentException('Nenhum dado enviado para atualização', 422);
        }
        
        if (isset($data['nome'])) {
            $this->validateNome($data['nome']);
        }

        if (isset($data['cpf'])) {
            $this->validaCPF($data['cpf']);
        }

        if (isset($data['dataNascimento'])) {
            $this->validateDate($data['dataNascimento']);
        }

        if (isset($data['idTurma'])) {
            $this->validateIdTurma($data['idTurma']);
        }

        if (isset($data['idStatus'])) {
            $this->validateIdStatus($data['idStatus']);
        }
    }

    private function validateNome(string $nome): void
    {
        if (strlen($nome) > 255) {
            throw new InvalidArgumentException('Campo "nome" deve ter no máximo 255 caracteres', 422);
        }
    }

    public function validaCPF(string $cpf): void
    {
        $cpf = preg_replace('/[^0-9]/is', '', $cpf);
        
        if (strlen($cpf) != 11) {
            throw new InvalidArgumentException('O campo "cpf" deve conter 11 dígitos', 422);
        }

        if (preg_match('/(\d)\1{10}/', $cpf)) {
            throw new InvalidArgumentException('O campo "cpf" não deve conter uma sequência de dígitos repetidos', 422);
        }

        for ($t = 9; $t < 11; $t++) {
            for ($d = 0, $c = 0; $c < $t; $c++) {
                $d += $cpf[$c] * (($t + 1) - $c);
            }
            $d = ((10 * $d) % 11) % 10;
            if ($cpf[$c] != $d) {
                throw new InvalidArgumentException('O valor do campo "cpf" é inválido', 422);
            }
        }
    }

    public function validateDate(string $dataNascimento): void
    {
        if (preg_match('/^\d{4}-\d{2}-\d{2}$/', $dataNascimento) === 0) {
            throw new InvalidArgumentException('Campo "dataNascimento" deve ter o formato Y-m-d', 422);
        }
    }

    private function validateIdTurma(int $idTurma): void
    {
        if (!is_int($idTurma)) {
            throw new InvalidArgumentException('Campo "idTurma" deve ser um valor inteiro', 422);
        }
        if ($idTurma <= 0) {
            throw new InvalidArgumentException('Campo "idTurma" deve ser um ID válido', 422);
        }
    }

    private function validateIdStatus($idStatus): void
    {
        if (!is_int($idStatus)) {
            throw new InvalidArgumentException('Campo "idStatus" deve ser um valor inteiro', 422);
        }
        if ($idStatus <= 0) {
            throw new InvalidArgumentException('Campo "idStatus" deve ser um ID válido', 422);
        }
    }
}
