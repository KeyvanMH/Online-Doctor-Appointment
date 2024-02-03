<?php
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');

include_once "../ErrorHandling/errorHandling.php";
if($_SERVER['REQUEST_METHOD'] == "POST"){
    spl_autoload_register(function($className){
        require_once "Classes/$className.php";
    });
    include_once "../DataBase/Db.php";
        include "../jwt/jwtValidator.php";
        include "../jwt/jwtGenerator.php";
        $input = $_POST['input'];
        $password = $_POST['password'];
        // email , phone number , id 
        $loginFormat = loginFormat::loginFormat($input);
        session_start();
        switch ($loginFormat) {
            case 'EMAIL':
                //fetch user with EMAIL from db
                $dbArray = Db::fetchUserEmail($input);
                $checkHash = checkHash::isHash($dbArray['password']);
                    if(!$checkHash){
                        if ($password == "1") {
                            // header("location:setPass.php");//actually must go to front end and connect's to the setPass.php
                            echo "make your pass better";
                        }else {
                            echo json_encode("wrong password"); //TODO: api form and error handling
                            
                        }

                    }else{
                        $checkPass = password_verify($password,$dbArray['password']);
                            if ($checkPass) {
                                $jwt = JwtGenerator::JwtGenerator($dbArray['id']);
                                $_SESSION['id'] = $dbArray['id'];
                                $_SESSION['reNew'] = true;
                                setcookie("jwt",$jwt,time()+60*60*24*2);
                                header("location:../front/dashboard.php");
                            }else {
                                echo "wrong password!"; //TODO: api form and error handling
                            }
                }
                break;


            case 'ID':
                // fetch user with ID from db
                $dbArray = Db::fetchUserId($input);
                $checkHash = checkHash::isHash($dbArray['password']);
                    if(!$checkHash){
                        if ($password == "1") {
                            // header("location:setPass.php");//actually must go to front end and connect's to the setPass.php
                            echo "make your pass better";
                        }else {
                            echo json_encode("wrong password"); //TODO: api form and error handling
                            
                        }

                    }else{
                        $checkPass = password_verify($password,$dbArray['password']);
                            if ($checkPass) {
                                $jwt = JwtGenerator::JwtGenerator($dbArray['id']);
                                $_SESSION['id'] = $dbArray['id'];
                                $_SESSION['reNew'] = true;
                                setcookie("jwt",$jwt,time()+60*60*24*2,'/');
                                header("location:../front/dashboard.php");
                            }else {
                                echo "wrong password!"; //TODO: api form and error handling
                            }
                }
                break;
            case 'PHONE':
                //fetch user with PHONE from db   
                $dbArray = Db::fetchUserPhone($input);
                $checkHash = checkHash::isHash($dbArray['password']);
                    if(!$checkHash){
                        if ($password == "1") {
                            // header("location:setPass.php");//actually must go to front end and connect's to the setPass.php
                            echo "make your pass better";
                        }else {
                            echo json_encode("wrong password"); //TODO: api form and error handling
                        }

                    }else{
                        $checkPass = password_verify($password,$dbArray['password']);
                            if ($checkPass) {
                                $jwt = JwtGenerator::JwtGenerator($dbArray['id']);
                                $_SESSION['id'] = $dbArray['id'];
                                $_SESSION['reNew'] = true;
                                setcookie("jwt",$jwt,time()+60*60*24*2);
                                header("location:../front/dashboard.php");
                            }else {
                                echo "wrong password!"; //TODO: api form and error handling
                            }
                }
                break;
        
        }
    
}else {
    errorHandling::inValidRequest();
}