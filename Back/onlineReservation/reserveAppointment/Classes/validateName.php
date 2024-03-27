<?php
class validateName{
    public static function validateName($name){
        $nameArray = str_split($name);
        $isNumeric = false;
        $numArray = [1,2,3,4,5,6,7,8,9];
        for ($i=0; $i <count($nameArray) ; $i++) { 
            foreach ($numArray as $value) {
                if ($value == $nameArray[$i]) {
                    $isNumeric = true;
                }
            }
        }

        if ( (array_key_last($nameArray) > 31) || ($isNumeric == true) || (array_key_last($nameArray)<2) ) {
            errorHandling::inValidInput();
        }

    }
}