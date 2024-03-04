<?php
//check security and session and jwt 
//request method put and delete
//server request uri
//reserve , delete 
session_start();


// echo $_SERVER['REQUEST_URI'];
// echo "</br>";
// echo $_SERVER['REQUEST_METHOD'];
// echo "</br>";

include "../jwt/jwtGenerator.php";
include "../jwt/jwtValidator.php";
include "../DataBase/Db.php";
include "../ErrorHandling/errorHandling.php";
require "accountSecurity/checkJwt.php";
require "accountSecurity/checkSession.php";
date_default_timezone_set('Asia/Tehran');
spl_autoload_register(function($className){
    require "Classes/$className.php";
});

$requestUri = request::requestFinder($_SERVER['REQUEST_URI']);
$request_method = $_SERVER['REQUEST_METHOD'];
switch ($request_method) {
    case 'DELETE':
        //format of uri for DELETE: URI?Appointment=number
        //get appointment ID and validate it
        $deleteAppointmentID = request::requestDelete($requestUri);
        //check if $deleteAppointmentID exist in DB
        //make the status of that appointment to 0 (we dont delete data from DB)
        DB::deleteAppointment($deleteAppointmentID,$_SESSION['id']);
        http_response_code(200);
        echo json_encode('Appointment Deleted!');
        break;
        
    case 'PUT':
        //validate request
        request::requestPut($requestUri);
        //validate clock with db appointments 
        $hoursArray = Db::fetchAppointment($requestUri,$_SESSION['id']);
        validateTime::validTime($hoursArray,$requestUri);
        //put data in db
        Db::putAppointment($requestUri);
        


        break;
    
    default:
        errorHandling::inValidRequest();
        break;
}
