<?php
class validatePhoneNum{
    public static function validatePhoneNum($phoneNum){
        $phoneNumber = str_split($phoneNum);
        $numArray = [0,1,2,3,4,5,6,7,8,9];
        foreach ($phoneNumber as $cell) {
            if(!in_array($cell,$numArray)){
                errorHandling::inValidInput();
            }
        }
        
        if ($phoneNumber[0] != 0 || $phoneNumber[1] != 9 || count($phoneNumber) !== 11) {
            errorHandling::inValidInput();
        }
    }

}