<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json; charset=utf-8');
include "../../DataBase/Db.php";
include_once "../../ErrorHandling/errorHandling.php";
spl_autoload_register(function($className){
    include_once "Classes/$className.php";
});


$id = $_POST['id']??null;
if ($id !== null) {
    $schedule = Db::showDocDbForPatient($id);
    echo json_encode($schedule);
}else {
    errorHandling::inValidRequest();
}
