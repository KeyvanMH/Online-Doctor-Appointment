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

        $input = $_POST['input']??null;
        $password = $_POST['password']??null;
        if (empty($input) or empty($password)) {
            errorHandling::inValidRequest();
        }
        // email , phone number , id 
        $loginFormat = loginFormat::loginFormat($input);
        session_start();
        switch ($loginFormat) {
            case 'EMAIL':
                //fetch user with EMAIL from db
                $dbArray = Db::fetchUserEmail($input);
                if (empty($dbArray)) {
                    errorHandling::inValidUser();
                }
                $checkHash = checkHash::isHash($dbArray['password']);
                    if(!$checkHash){
                        if ($password == "1") {
                            $jwt = JwtGenerator::JwtGenerator($dbArray['id']);
                            $_SESSION['id'] = $dbArray['id'];
                            $_SESSION['reNew'] = true;
                            setcookie("jwt",$jwt,time()+60*60*24*2,'/');
                            echo json_encode('weak password');
                        }else {
                            errorHandling::wrongPassword();                            
                            
                        }

                    }else{
                        $checkPass = password_verify($password,$dbArray['password']);
                            if ($checkPass) {
                                $jwt = JwtGenerator::JwtGenerator($dbArray['id']);
                                $_SESSION['id'] = $dbArray['id'];
                                $_SESSION['reNew'] = true;
                                setcookie("jwt",$jwt,time()+60*60*24*2,'/');
                                echo json_encode(true);
                            }else {
                                errorHandling::wrongPassword();                            
                            }
                }
                break;


            case 'ID':
                // fetch user with ID from db
                $dbArray = Db::fetchUserId($input);
                if (empty($dbArray)) {
                    errorHandling::inValidUser();
                }
                    $checkHash = checkHash::isHash($dbArray['password']);
                    if(!$checkHash){
                        if ($password == "1") {
                            $jwt = JwtGenerator::JwtGenerator($dbArray['id']);
                            $_SESSION['id'] = $dbArray['id'];
                            $_SESSION['reNew'] = true;
                            setcookie("jwt",$jwt,time()+60*60*24*2,'/');
                            echo json_encode('weak password');
                        }else {
                            errorHandling::wrongPassword();                            
                        }

                    }else{
                        $checkPass = password_verify($password,$dbArray['password']);
                            if ($checkPass) {
                                $jwt = JwtGenerator::JwtGenerator($dbArray['id']);
                                $_SESSION['id'] = $dbArray['id'];
                                $_SESSION['reNew'] = true;
                                setcookie("jwt",$jwt,time()+60*60*24*2,'/');
                                echo json_encode(true);
                            }else {
                                errorHandling::wrongPassword();
                            }
                }
                break;
            case 'PHONE':
                //fetch user with PHONE from db   
                $dbArray = Db::fetchUserPhone($input);
                if (empty($dbArray)) {
                    errorHandling::inValidUser();
                }
                $checkHash = checkHash::isHash($dbArray['password']);
                    if(!$checkHash){
                        if ($password == "1") {
                            $jwt = JwtGenerator::JwtGenerator($dbArray['id']);
                            $_SESSION['id'] = $dbArray['id'];
                            $_SESSION['reNew'] = true;
                            setcookie("jwt",$jwt,time()+60*60*24*2,'/');
                            echo json_encode('weak password');
                        }else {
                            errorHandling::wrongPassword();                            
                        }

                    }else{
                        $checkPass = password_verify($password,$dbArray['password']);
                            if ($checkPass) {
                                $jwt = JwtGenerator::JwtGenerator($dbArray['id']);
                                $_SESSION['id'] = $dbArray['id'];
                                $_SESSION['reNew'] = true;
                                setcookie("jwt",$jwt,time()+60*60*24*2,'/');
                                echo json_encode(true);
                            }else {
                                errorHandling::wrongPassword();                            
                            }
                }
                break;
        
        }
    
}else {
    errorHandling::inValidRequest();
}