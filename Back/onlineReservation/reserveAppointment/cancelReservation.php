<?php
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');

include "../../DataBase/Db.php";
include_once "../../ErrorHandling/errorHandling.php";

$appointmentId = $_POST['appointmentId']??null;
if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    errorHandling::inValidRequest();
}
if ($appointmentId == null) {
    errorHandling::inValidInput();
}
//make status 0 in both table's
Db::cancellReservation($appointmentId);
echo json_encode(true);