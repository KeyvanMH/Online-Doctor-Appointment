<?php
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');

include "../DataBase/Db.php";
include_once "../ErrorHandling/errorHandling.php";

if ($_SERVER['REQUEST_METHOD'] !== "post") {
    errorHandling::inValidRequest();
}
spl_autoload_register(function($className){
    include_once "Classes/$className.php";
});

//this must be ajax
$input = $_POST['input'];
$filterGender = $_POST['gender']??null;
$filterMajor = $_POST['major']??null;
$filterCity = $_POST['city']??null;
// $filterSickness = $_POST['sickness']??null;
//default sort relevant
$sort = "relevant";
if (isset($_POST['sort'])) {
    $sort = strtolower(trim($_POST['sort']));//alphabatic , ascesnding , descendinng 
}

//validate filter's
validation::validation($filterCity,$filterMajor,$filterGender);
//db filter
$docotrs = DB::showDocDbFilter($filterCity,$filterMajor,$filterGender);
//input
$result = search::search($input,$docotrs);    
//sort
$sortedResult = sort::sort($result,$sort);
//return
return $sortedResult;




/**
 * @param string $sort
 * @param string $filter
 * @param string $input
 */

