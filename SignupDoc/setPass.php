<?php
// header("Content-Type: application/json");
session_start();
spl_autoload_register(function($className){
    require_once "Classes/$className.php";
});
// echo $_SESSION['id'];
$password = $_POST['password'];
$validPass = validator::password($password);
if ($validPass == true) {
    //hash password
    $hashedPass = hashPass::hashPassword($password);
    include "../DataBase/Db.php";
    Db::updatePassword($hashedPass,$_SESSION['id']);
    // header("location:DoctorPanel");
}else{
    //error handling
}
session_unset();
