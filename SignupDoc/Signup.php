<?php
// header("contenttype");
// header("requestmethodPOST");
// header("originx*");

// file_get_contents("php://input"); //can be used
//information's about doctors
spl_autoload_register(function($className){
    require_once "Classes/$className.php";
});

$doctorInfo = [
0 =>$_POST["first"],    //validate name without any number   fname 
1 =>$_POST["last"],    //validate name without any number   lanme
// $username = $_POST[""];     //validate  #must have a seperate page 
2 =>$_POST["fileNumber"], //validate شماره پرونده filenumber
3 =>$_POST["phoneNumber"],   //validate number without any char    phonenumber
4 =>$_POST["city"],     //just peice of chars   city
5 =>$_POST["clinikAddress"],    //just peice of chars    clinik address
6 =>$_POST["major"],    //just peice of chars    major
7 =>$_POST["expertise"],    //just peice of chars    expertise
8 =>$_POST["email"],     //validate email with filter    email
9 =>$_POST["gender"]  //just peice of chars   gender 
];


// validate data 
$doctor = new validator($doctorInfo);
$array = get_class_methods($doctor);
unset($array[0]); // delete __construct function from $array array
$methods = array_values($array);
$output = true;
foreach ($methods as $value) {
    $output = $doctor->$value();
    if ($output == false) {
        // error::class;
        echo $value;
        break;
    }
}



// if ($output==true) {
//     echo "test accepted!";
//     //sanitize input data 
//     // insert databse

// }elseif($output == null){
//     echo "test failed";
// }
// else{
//     echo "test modified";
// }

//send user to fronpage 