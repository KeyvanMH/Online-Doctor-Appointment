<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json; charset=utf-8');
session_start();

if (isset($_COOKIE['jwt'])) {
    //insert jwt module
    $jwt = $_COOKIE['jwt'];
    include "../jwt/jwtGenerator.php";
    include "../jwt/jwtValidator.php";
    include "../DataBase/Db.php";
    include "../ErrorHandling/errorHandling.php";
    $validJwt = jwtValidator::validator($jwt);
    if ($validJwt != false) {
        $_SESSION['id'] = $validJwt;
        echo json_encode(true);
    }else{
        echo json_encode(false);
    }
}elseif (empty($_COOKIE['jwt'])) {
    echo json_encode(false);
}

