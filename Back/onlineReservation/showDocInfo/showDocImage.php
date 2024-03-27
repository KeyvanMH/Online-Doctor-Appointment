<?php
header('Access-Control-Allow-Origin: *');

include "../../DataBase/Db.php";
include_once "../../ErrorHandling/errorHandling.php";

if ($_SERVER['REQUEST_METHOD'] !== "GET") {
    errorHandling::inValidRequest();
}
if (empty($_GET['id'])) {
    errorHandling::inValidRequest();
}
$doctorId = $_GET['id'];
$path = Db::showImage($doctorId);
if (!empty($path)) {
    header('Content-Type: image/jpeg');
    readfile("../../image/".$path['profileImage']);
}else{
    errorHandling::inValidInput();
}