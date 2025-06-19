<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\JwtHelper;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class AuthorizationController extends Controller
{
    public function generate(Request $request)
    {
        try{
            $token = JwtHelper::generateToken();
            return response()->json(['message' => 'Token gerado com sucesso.', 'token' => $token], Response::HTTP_OK);
        } catch (Throwable $th) {
            return response()->json(['message' => $$th->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}