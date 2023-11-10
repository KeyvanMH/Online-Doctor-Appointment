<?php
// header("contenttype");
// header("requestmethodPOST");
// header("originx*");

spl_autoload_register(function($className){
    require_once "Classes/$className.php";
});


//Sanitize input name
$sanitizeDoctor = new sanitize();

$doctorInfo = [
0 =>$sanitizeDoctor->nameSanitize($_POST["first"]),//sanitized first name
1 =>$sanitizeDoctor->nameSanitize($_POST["last"]), //sanitized last name    
2 =>$_POST["fileNumber"], 
3 =>$_POST["phoneNumber"],
4 =>$_POST["city"],     
5 =>$_POST["clinikAddress"],
6 =>$_POST["major"],    
7 =>$_POST["expertise"], 
8 =>$_POST["email"],  
9 =>$_POST["gender"]
];


// Validate data and go to error  class in case of validate issue
$validDoctor = new validator($doctorInfo);
$array = get_class_methods($validDoctor);
unset($array[0]); // delete __construct function from $array array
$methods = array_values($array);
$output = true;
foreach ($methods as $value) {
    $output = $validDoctor->$value();
    if ($output == false) {
        // error::class;
        echo $value;
        break;
    }
}





if ($output==true) {
    // insert databse
    echo 1;

}
// elseif($output == null){
//     echo "test failed";
// }

//send user to fronpage 