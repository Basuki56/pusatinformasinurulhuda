<?php

namespace App\Services;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class JwtService
{
    public function encode($payload)
    {
        return JWT::encode($payload, config('app.key'), 'HS256');
    }

    public function decode($token)
    {
        return JWT::decode($token, new Key(config('app.key'), 'HS256'));
    }
}
