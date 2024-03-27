<?php
session_start();
//TODO: header
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
        //format of uri for DELETE: URI?AppointmentID=number
        //get appointment ID and validate it
        $deleteAppointmentID = request::requestDelete($requestUri);
        //check if $deleteAppointmentID exist in DB
        //make the status of that appointment to 0 (we dont delete data from DB)
        DB::deleteAppointment($deleteAppointmentID,$_SESSION['id']);
        echo json_encode(true);
        break;
        
    case 'PUT':
        //validate request
        request::requestPut($requestUri);
        //validate clock with db appointments 
        $hoursArray = Db::fetchHourAppointment($requestUri,$_SESSION['id']);
        validateTime::validTime($hoursArray,$requestUri);
        //put data in db
        Db::putAppointment($requestUri,$_SESSION['id'],null,null);
        Db::insertAppointmentTable($requestUri,$_SESSION['id'],"Null","doctor".$_SESSION['id']);
        echo json_encode(true);
        break;
    
    default:
        errorHandling::inValidRequest();
        break;
}
