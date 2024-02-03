<?php
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');

include_once "../ErrorHandling/errorHandling.php";

if($_SERVER['REQUEST_METHOD'] == "POST"){
    session_start();
    spl_autoload_register(function($className){
        require_once "Classes/$className.php";
    });
    $password = $_POST['password'];
    $validPass = validator::password($password);
    if ($validPass == true) {
        //hash password
        $hashedPass = hashPass::hashPassword($password);
        include "../DataBase/Db.php";
        include "../jwt/jwtGenerator.php";
        Db::updatePassword($hashedPass,$_SESSION['id']);
        //generate and set jwt
        $jwt = JwtGenerator::JwtGenerator($_SESSION['id']);
        setcookie("jwt",$jwt,time()+60*60*24*2);
        //make a  database for dactor appointment with id name 
        if (isset($_SESSION['id'])) {
            Db::makeDataBase($_SESSION['id']);
            header("location:../front/dashboard.php");
        }else {
            errorHandling::internalError();            
        }
    }else{
        errorHandling::inValidInput();
    }
}else {
    errorHandling::inValidRequest();
}
