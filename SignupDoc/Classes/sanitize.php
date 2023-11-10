<?php
class sanitize{
    public $fname;
    public $lname;

    public function nameSanitize($input){
        $trim = trim($input);
        $output = str_replace(" ","",$trim);
        return $output;
    }

}