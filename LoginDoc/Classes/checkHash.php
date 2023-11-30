<?php
class checkHash{
    public static function isHash($input){
        $charNum = strlen($input);
        if ($charNum != 1) {
            return true;
        }elseif ($charNum == 1) {
            return false;
        }

    }
}