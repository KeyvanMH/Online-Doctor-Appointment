<?php
// renew jwt 
// Intl Calendar
// chnage info
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
include "../jwt/jwtGenerator.php";
include "../jwt/jwtValidator.php";
include "../DataBase/Db.php";
include "../ErrorHandling/errorHandling.php";
session_start();

//check securities(jwt and session's)
require "accountSecurity/checkJwt.php";
require "accountSecurity/checkSession.php";
//renew the jwt by the acivation of the session just once (consider renew session)
spl_autoload_register(function($className){
    require "Classes/$className.php";
});
date_default_timezone_set('Asia/Tehran');
$time = Db::showStatus();
$appointmentId = changeStatus::changeStatus($time);
if ($appointmentId !== null) {
    Db::changeStatus($appointmentId);
}


if (empty($_SESSION['reNew']) or $_SESSION['reNew'] == false) {
    new reNewJwt($_SESSION['id']);
    $_SESSION['reNew'] = true;
}

//calender : see 
$table = DB::showDocDb($_SESSION['id']);
print_r(json_encode($table));
echo $_SESSION['id'];


 