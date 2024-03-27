<?php
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');

include "../../DataBase/Db.php";
include_once "../../ErrorHandling/errorHandling.php";

if ($_SERVER['REQUEST_METHOD'] !== "POST") {
    errorHandling::inValidRequest();
}
spl_autoload_register(function($className){
    include_once "Classes/$className.php";
});
date_default_timezone_set('Asia/Tehran');


if (empty($_POST['id']) or empty($_POST['year']) or empty($_POST['month']) or empty($_POST['day']) or empty($_POST['hour']) or empty($_POST['phoneNum']) or empty($_POST['name'])) {
    errorHandling::inValidRequest();
}
$id = $_POST['id'];
$phoneNum = $_POST['phoneNum'];
$patientName = $_POST['name'];

$requestUri = "year=".$_POST['year']."&month=".$_POST['month']."&day=".$_POST['day']."&hour=".$_POST['hour'];


//validate request
validatePhoneNum::validatePhoneNum($phoneNum);
request::requestPut($requestUri);
//validate clock with db appointments 
$hoursArray = Db::fetchHourAppointment($requestUri,$id);
validateTime::validTime($hoursArray,$requestUri);
//put data in db
Db::putAppointment($requestUri,$id,$phoneNum,$patientName);

// reset status of the past time in appointment
$time = Db::showAppointmentTableStatus();
$appointmentId = changeStatus::changeStatus($time);
if ($appointmentId !== null) {
    Db::changeAppointmentTableStatus($appointmentId);
}

//insert in appointment table
$appointmentId = Db::insertAppointmentTable($requestUri,$id,$phoneNum,$patientName);
echo json_encode($appointmentId);