<?php

namespace App\Http\Middleware;

use Closure;
use DateTime;
use Illuminate\Http\Request;
use InvalidArgumentException;
use Symfony\Component\HttpFoundation\Response;
use Throwable;
use Laminas\Validator\Date;

class AlunoValidation
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
        } catch (Throwable $th) {
            return response()->json(['message' => $th->getMessage(), 'statusCode' => $th->getCode()], $th->getCode());
        }
        return $next($request);
    }

    private function validateData(array $data): void
    {
        if (empty($data)) {
            throw new InvalidArgumentException('Dados vazios enviados', 422);
        }
        if (!isset($data['nome']) || empty($data['nome'])) {
            throw new InvalidArgumentException('Campo "nome" deve ser enviado e não pode ser vazio', 422);
        }
        if (!isset($data['cpf']) || empty($data['cpf'])) {
            throw new InvalidArgumentException('Campo "cpf" não deve ser vazio', 422);
        }
        $this->validaCPF($data['cpf']);
        $this->validateDataNascimento($data);
        if (!isset($data['dataNascimento'])) {
            throw new InvalidArgumentException('Campo "dataNascimento" deve ser enviado e não pode ser vazio', 422);
        }
        if (!isset($data['idTurma']) || !is_int($data['idTurma'])) {
            throw new InvalidArgumentException('Campo "idTurma" deve ser enviado como valor inteiro', 422);
        }
        if (!isset($data['idStatus']) || !is_int($data['idStatus'])) {
            throw new InvalidArgumentException('Campo "idStatus" deve ser enviado como valor inteiro', 422);
        }
    }

    private function validateDataNascimento(array $data): void
    {
        $validator = new Date(['format' => 'Y-m-d', 'strict' => true]);
        if (!$validator->isValid($data['dataNascimento'])) {
            throw new InvalidArgumentException('Campo "dataNascimento" deve ser enviado no formato: Y-m-d(Ano-Mês-Dia)', 422);
        }
        $dataNasc = DateTime::createFromFormat('Y-m-d', $data['dataNascimento']);
        $hoje = new DateTime();
        if ($dataNasc > $hoje) {
            throw new InvalidArgumentException(' A "dataNascimento" não deve ser maior do que a data Atual.', 422);
        }
    }

    public function validaCPF(string $cpf): void
    {
        $cpf = preg_replace('/[^0-9]/is', '', $cpf);
        if (strlen($cpf) != 11) {
            throw new InvalidArgumentException('O campo "cpf" deve conter 11 digitos', 422);
        }
        if (preg_match('/(\d)\1{10}/', $cpf)) {
            throw new InvalidArgumentException('O campo "cpf" não deve conter uma sequencia de digitos repetidos', 422);
        }
        for ($t = 9; $t < 11; $t++) {
            for ($d = 0, $c = 0; $c < $t; $c++) {
                $d += $cpf[$c] * (($t + 1) - $c);
            }
            $d = ((10 * $d) % 11) % 10;
            if ($cpf[$c] != $d) {
                throw new InvalidArgumentException('O valor campo "cpf" é invalido', 422);
            }
        }
    }

    // public function validateDate(string $dataNascimento): void
    // {
    //     if (preg_match('/^\d{4}-\d{2}-\d{2}$/', $dataNascimento) === 0) {
    //         throw new InvalidArgumentException('Campo "dataNascimento" deve ter o formato Y-m-d', 422);
    //     }
    // }
}
