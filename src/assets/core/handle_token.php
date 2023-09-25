<?php

$PUBLIC_KEY = getenv('PUBLIC_KEY');
$keyFilePath = $ROOT_PATH . '/secrets/public.key';

require_once $ROOT_PATH . '/assets/core/lib/jwt/src/JWT.php';
require_once $ROOT_PATH . '/assets/core/lib/jwt/src/Key.php';

use \Firebase\JWT\JWT;
use \Firebase\JWT\Key;

class JWToken {
    

    public static function decodeToken($token)  {
        global $keyFilePath;
        $secretKey = trim(file_get_contents($keyFilePath));
        return JWT::decode($token, new Key($secretKey, 'RS256'));
    }

}

