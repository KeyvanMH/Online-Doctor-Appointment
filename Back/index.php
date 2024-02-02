<?php
include_once "ErrorHandling/errorHandling.php";
session_start();
var_dump($_SESSION);
echo "</br>";
echo $_COOKIE['jwt'];
errorHandling::internalError();
