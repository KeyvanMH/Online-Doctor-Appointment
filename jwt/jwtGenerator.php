<?php
//this page must generate jwt 
include "../vendor/autoload.php";
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
// key salt
$key = 'keyvan';
$payload = [
    'iss' => 'http://example.org',
    'aud' => 'http://example.com',
    'iat' => 1356999524,
    'nbf' => 1357000000
];
$jwt = JWT::encode($payload, $key, 'HS256');
print_r($jwt);
echo "</br>";
$decoded = JWT::decode($jwt, new Key($key, 'HS256'));
print_r($decoded);

