<?php
class sanitize{
    public $fname;
    public $lname;

    public function nameSanitize($input){
        $trim = trim($input);
        $output = str_replace(" ","",$trim);
        return $output;
    }

    
    public function DBsanitize($input){
        $sanitizedData = array();
      foreach ($input as  $value) {
        $holder = htmlspecialchars(strip_tags($value)); //sanitize data before insert in data base 
        array_push($sanitizedData,$holder);
      }
      return $sanitizedData;
    }

}