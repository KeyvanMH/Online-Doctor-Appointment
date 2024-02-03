<?php
header('Access-Control-Allow-Origin: *');
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
        header("location:../front/dashboard.php");
    }else{
        $_SESSION['check']=true;
        header("location:../front/login.php");
    }
}elseif (empty($_COOKIE['jwt'])) {
    $_SESSION['check']=true;
    header("location:../front/login.php");
}

