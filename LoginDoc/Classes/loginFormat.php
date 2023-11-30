<?php
class loginFormat {
    private static function isEmail($input){
        $isEmail = filter_var($input,FILTER_VALIDATE_EMAIL);
        if ($isEmail) {
            return TRUE;
        }else {
            return FALSE;
        }
    }

    private static function isID($input){
        $number = "0123456789";
        $numberArray = str_split($number);
        $inputCounter = str_split($input);
        //check if the input is 5 element
        if (count($inputCounter) !== 5) {
            return FALSE;
        }
        // check if the input is only number character
        foreach ($inputCounter as $value) {
            if (!in_array($value,$numberArray)) {
                return FALSE;
            }
        }
        
        //check if the number is bigger than 20000
        if ($input < 20000 ) {
            return FALSE;
        }
        return TRUE;
    }


    private static function isPhoneNumber($input){
        $phoneNumber = str_split($input);
        $numArray = [0,1,2,3,4,5,6,7,8,9];
        for ($i=0; $i <11 ; $i++) { 
            if(!in_array($phoneNumber[$i],$numArray)){
                return false;
            }
        }
        if ($phoneNumber[0] != 0 || $phoneNumber[1] != 9 || count($phoneNumber) !== 11) {
            return false;
        }
        return true;

    }
    public static function loginFormat($input){
        if (self::isEmail($input) == TRUE) {
            return "EMAIL";
        }elseif (self::isID($input) == TRUE) {
            return "ID";
        }elseif (self::isPhoneNumber($input) == TRUE) {
            return "PHONE";
        }
    }

}
