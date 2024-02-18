<?php
if (isset($_COOKIE['jwt'])) {
    //insert jwt module
    $jwt = $_COOKIE['jwt'];
    $validJwt = jwtValidator::validator($jwt);
    if ($validJwt == false) {
        $_SESSION['check']=true;
        header("location:login.php");
        exit();
    }
}elseif (empty($_COOKIE['jwt'])) {
    $_SESSION['check']=true;
    header("location:login.php");
    exit();
}

