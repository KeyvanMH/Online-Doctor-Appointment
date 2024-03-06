<?php
session_start();
//change profile image 
//change data from the doctor table 
include "../jwt/jwtGenerator.php";
include "../jwt/jwtValidator.php";
include "../DataBase/Db.php";
include "../ErrorHandling/errorHandling.php";
require "accountSecurity/checkJwt.php";
require "accountSecurity/checkSession.php";
spl_autoload_register(function($className){
    require "Classes/$className.php";
});
$method = $_SERVER['REQUEST_METHOD'];
switch ($method) {
    case 'POST':
        echo 'post';
        break;

    case 'PUT':
        echo 'put';
        break;
    
    default:
    errorHandling::inValidRequest();
        break;
}

