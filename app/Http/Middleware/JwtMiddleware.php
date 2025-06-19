<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Helpers\JwtHelper;
use InvalidArgumentException;
use Throwable;

class JwtMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        try {

            $token = $request->bearerToken();
            if (empty($token)) {
                throw new InvalidArgumentException('Token não fornecido.', Response::HTTP_UNAUTHORIZED);
            }
            if (!JwtHelper::validateToken($token)) {
                throw new InvalidArgumentException('Token invalido.', Response::HTTP_UNAUTHORIZED);
            }
        } catch (Throwable $th) {
            return response()->json(['error' => $th->getMessage()], $th->getCode());
        }
        return $next($request);
    }
}
