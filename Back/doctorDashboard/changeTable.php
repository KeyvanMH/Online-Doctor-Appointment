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


include "../DataBase/Db.php";
include "../ErrorHandling/errorHandling.php";

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
        //validate clock with db appointments 
        //put data in db
        request::requestPut($requestUri);

        // echo $requestUri;


        // $output = json_decode($data);
        // echo $output;
        //put method -> check if in that time no other appointment exist , check if it is in future 
        break;
    
    default:
        # ERROR
        break;
}
