<?php
class validateProfileChangeRequest {

    public static function validation($request){
        //check not to be empty
        if (empty($request)) {
            errorHandling::inValidRequest();
        }
        //validate uri to has just one request
        $requestArray = explode("&",$request);
        $num = count($requestArray);
        if ($num !== 1) {
            errorHandling::inValidRequest();
        }

        //check for uri to has no more than one 'equal sign' (=)
        $output = explode('=',$request);
        $outputNum = count($output);
        if ($outputNum != 2) {
            errorHandling::inValidRequest();
        }
        $value = $output[1];
        $column = strtolower(trim($output[0]));
        switch ($column) {
            case 'password':
                //bigger than 8 , smaller than 31 , have both character and number's 
                $number = "0123456789";
                $numberArray =  str_split($number);
                $character = "abcdefghijklmnopqrstuvwxyz";
                $charArray = str_split($character);
                $inputArray = str_split($value);
                if (strlen($value)<8 || strlen($value)>31 ) {
                    errorHandling::inValidInput();
                }

                //check if it has integer
                $includeNum = false;
                foreach ($inputArray as  $cell) {
                    if (in_array($cell,$numberArray)) {
                        $includeNum = true;
                    }
                }
                if ($includeNum == false) {
                    errorHandling::inValidInput();
                }

                //check if it has char
                $includeChar = false;
                foreach ($inputArray as  $cell) {
                    if (in_array($cell,$charArray)) {
                        $includeChar = true;
                    }
                }
                if ($includeChar == false) {
                    errorHandling::inValidInput();
                }
                break;


            case 'email':
                if (filter_var($value,FILTER_VALIDATE_EMAIL) == false) {
                    errorHandling::inValidInput();
                }
                break;


            case 'expertise':
                break;



            case 'clinic_address':
                break;



            case 'city':
                $city = file("../SignupDoc/Document/city.txt");
                $lowerCity = strtolower($value);
                $cityArray = array();
                foreach ($city as $cell) {
                    $holder = trim($cell);
                    array_push($cityArray,strtolower($holder));
                }
                if (!in_array($lowerCity,$cityArray)) {
                    errorHandling::inValidInput();
                }
                break;



            case 'contact_number':
                $phoneNumber = str_split($value);
                $numArray = [0,1,2,3,4,5,6,7,8,9];
                foreach ($phoneNumber as $cell) {
                    if(!in_array($cell,$numArray)){
                        errorHandling::inValidInput();
                    }
                }
                
                if ($phoneNumber[0] != 0 || $phoneNumber[1] != 9 || count($phoneNumber) !== 11) {
                    errorHandling::inValidInput();
                }
                break;
            


            default:
            errorHandling::inValidRequest();
                break;
        }

        

    }

    
}
