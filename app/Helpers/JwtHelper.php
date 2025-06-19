<?php

namespace App\Helpers;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use DomainException;
use UnexpectedValueException;

class JwtHelper
{
    public static function generateToken()
    {
        $payload = [
            'iss' => env('APP_URL'),
            'iat' => time(),
            'exp' => time() + env('JWT_EXPIRE', 3600), 
            'sub' => 1,
            'name' => 'Luiz',
        ];
        return JWT::encode($payload, env('JWT_SECRET'), env('JWT_ALGORITHM'));
    }

    public static function validateToken(string $token)
    {
        try {
            $decoded = JWT::decode($token, new Key(env('JWT_SECRET'), env('JWT_ALGORITHM')));
            return (array) $decoded;
        } catch (DomainException | UnexpectedValueException $exception) {
            return false;
        }
    }
}
