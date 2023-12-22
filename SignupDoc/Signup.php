<?php
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');

include_once "../ErrorHandling/errorHandling.php";

if($_SERVER['REQUEST_METHOD'] == "POST"){
    session_start();
    spl_autoload_register(function($className){
        require_once "Classes/$className.php";
    });


    //Sanitize input name
    $sanitizeDoctor = new sanitize();

    $doctorInfo = [
    0 =>$sanitizeDoctor->nameSanitize($_POST["first"]),//sanitized first name
    1 =>$sanitizeDoctor->nameSanitize($_POST["last"]), //sanitized last name    
    2 =>$_POST["fileNumber"], 
    3 =>$_POST["phoneNumber"],
    4 =>$_POST["city"],     
    5 =>$_POST["clinikAddress"],
    6 =>$_POST["major"],    
    7 =>$_POST["expertise"], 
    8 =>$_POST["email"],  
    9 =>$_POST["gender"],
    10 =>$_SERVER['REMOTE_ADDR'],
    11 =>date("y:m:d:h:i:s")


    ];


    // Validate data and go to error  class in case of validate issue
    $validDoctor = new validator($doctorInfo);
    $array = get_class_methods($validDoctor);
    unset($array[0],$array[9]); // delete __construct function from $array array
    $methods = array_values($array);
    $output = true;
    foreach ($methods as $value) {
        $output = $validDoctor->$value();
        if ($output == false) {
            break;
        }
    }





    if ($output == true) {
        // insert databse
        $sanitizeData = new sanitize();
        $info = $sanitizeData->DBsanitize($doctorInfo);
        include "../DataBase/Db.php";
        $id = Db::insertDoctorInfo($info);
        // $_SESSION['id'] = $id;
        // header("location:setPass.html");     
    }
    elseif($output == false){
        include "../ErrorHandling/errorHandling.php";
        echo errorHandling::inValidInput();
    }
}else {
    errorHandling::inValidRequest();
}