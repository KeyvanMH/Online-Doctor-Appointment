<?php
session_start();
//change profile image 
//change data from the doctor table 
include "../jwt/jwtGenerator.php";
include "../jwt/jwtValidator.php";
include "../DataBase/Db.php";
include "../ErrorHandling/errorHandling.php";
require "accountSecurity/checkJwt.php";
require "accountSecurity/checkSession.php";
spl_autoload_register(function($className){
    require "Classes/$className.php";
});
$method = $_SERVER['REQUEST_METHOD'];
switch ($method) {
    case 'POST':
        if (isset($_FILES['profileImage'])) {
            if (is_uploaded_file($_FILES['profileImage']['tmp_name'])) {
                $image = $_FILES['profileImage'];
                $tmpName = $image['tmp_name'];
                //validate if image has suitable size and format
                validateImage::validateImage($image); 
                //save image in the image folder
                $imageAddress = saveImage::saveImage($tmpName);
                //save address of that picture to the DB of that doctor
                DB::saveImageAddress($imageAddress);
                echo json_encode(true);
            }
        }

        break;

    case 'PUT':
        //get uri validate and add DB and change profile in doctor table
        $requestUri = $_SERVER['REQUEST_URI'];
        $request = request::requestFinder($requestUri);
        validateProfileChangeRequest::validation($request);
        //changeable : password , email ,expertise,clinik address,city,contactnumber,
        echo "everything is just fine!";
        break;
    
    default:
    errorHandling::inValidRequest();
        break;
}

