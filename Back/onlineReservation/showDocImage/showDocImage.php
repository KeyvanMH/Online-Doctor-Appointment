<?php
// header('Access-Control-Allow-Origin: *');

include "../../DataBase/Db.php";
include_once "../../ErrorHandling/errorHandling.php";

if ($_SERVER['REQUEST_METHOD'] !== "GET") {
    errorHandling::inValidRequest();
}
echo $_GET['id'];
// if (empty($_GET['id'])) {
//     errorHandling::inValidRequest();
// // }
// header('Content-Type: image/jpeg');
// $doctorId = $_GET['id'];
// $path = Db::showImage($doctorId);
// readfile("../../image/".$path);