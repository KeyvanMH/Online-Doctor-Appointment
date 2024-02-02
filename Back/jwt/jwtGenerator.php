<?php
//this page must generate jwt 
include "../vendor/autoload.php";
use Firebase\JWT\JWT;
class JwtGenerator{
    public static function JwtGenerator($userId){
        try {
        $key = 'KATATONIA';
        $payload = [
            'userId' => $userId,
            'nbf' => 1357000000,
            'exp' => time()+60*60*24*2 
        ];
        $jwt = JWT::encode($payload, $key, 'HS256');
        return $jwt;
        }  catch (\Exception $e) { 
            errorHandling::inValidCookie();
        }
    }
    
}