<?php
header('Access-Control-Allow-Origin: *');
session_start();

if (isset($_COOKIE['jwt'])) {
    //insert jwt module
    $jwt = $_COOKIE['jwt'];
    $validJwt = jwtValidator::validator($jwt);
    if ($validJwt == false) {
        $_SESSION['check']=true;
        header("location:../../front/login.php");
    }
}elseif (empty($_COOKIE['jwt'])) {
    $_SESSION['check']=true;
    header("location:../../front/login.php");
}

