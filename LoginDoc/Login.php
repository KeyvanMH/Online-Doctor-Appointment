<?php
spl_autoload_register(function($className){
    require_once "Classes/$className.php";
});
include_once "../DataBase/Db.php";
if (isset($_COOKIE['jwt'])) {
//insert jwt module

}else {
    $input = $_POST['input'];
    $password = $_POST['password'];
    // email , phone number , id 
    $loginFormat = loginFormat::loginFormat($input);
    switch ($loginFormat) {
        case 'EMAIL':
            //fetch user with EMAIL from db
            $dbPass = Db::fetchUserEmail($input);
            $checkHash = checkHash::isHash($dbPass);
                if(!$checkHash){
                    if ($password == "1") {
                        // header("location:setPass.php");//actually must go to front end and connect's to the setPass.php
                        echo "make your pass better";
                    }else {
                        echo json_encode("wrong password"); //TODO: api form and error handling
                        
                    }

                }else{
                    $checkPass = password_verify($password,$dbPass);
                        if ($checkPass) {
                            header("location:../index.php");
                        }else {
                            echo "wrong password!"; //TODO: api form and error handling
                        }
            }
            break;


        case 'ID':
            //fetch user with ID from db
            $dbPass = Db::fetchUserId($input);
            $checkHash = checkHash::isHash($dbPass);
                if(!$checkHash){
                    if ($password == "1") {
                        // header("location:setPass.php");//actually must go to front end and connect's to the setPass.php
                        echo "make your pass better";
                    }else {
                        echo json_encode("wrong password"); //TODO: api form and error handling
                        
                    }

                }else{
                    $checkPass = password_verify($password,$dbPass);
                        if ($checkPass) {
                            header("location:../index.php");
                        }else {
                            echo "wrong password!"; //TODO: api form and error handling
                        }
            }
            break;
        case 'PHONE':
            //fetch user with PHONE from db   
            $dbPass = Db::fetchUserPhone($input);
            $checkHash = checkHash::isHash($dbPass);
                if(!$checkHash){
                    if ($password == "1") {
                        // header("location:setPass.php");//actually must go to front end and connect's to the setPass.php
                        echo "make your pass better";
                    }else {
                        echo json_encode("wrong password"); //TODO: api form and error handling
                        
                    }

                }else{
                    $checkPass = password_verify($password,$dbPass);
                        if ($checkPass) {
                            header("location:../index.php");
                        }else {
                            echo "wrong password!"; //TODO: api form and error handling
                        }
            }
            break;
    
    }
}