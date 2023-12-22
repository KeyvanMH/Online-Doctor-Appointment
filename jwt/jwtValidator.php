<?php
//this page must validate the jwt that it really belong to user with data in db and it must check and validate the expire time
include "../vendor/autoload.php";
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
class jwtValidator {
    public static function validator($jwt){
        $key = 'KATATONIA';
        $decoded = JWT::decode($jwt,new Key($key, 'HS256'));
        //check if the user id exist in database
        $validJwt = DB::fetchUserIdJwt($decoded->userId);
        $expirationTime = $decoded->exp;
        $timeValid = $expirationTime < time()?false:true;
        if ($validJwt and $timeValid == true) {
            return true;
        }else {
            return false;
        }      

    }   
    
}
