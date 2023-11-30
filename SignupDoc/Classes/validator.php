<?php
class validator{
    //properties
    public $fname;
    public $lname;
    public $fileNumber;
    public $number;
    public $city;
    public $clinikAddress;
    public $major;
    public $expertise;
    public $emailAddress;
    public $gender;




    //function's
    public function __construct(array $input){
        $this->fname = $input[0];
        $this->lname = $input[1];
        $this->fileNumber = $input[2];
        $this->number = $input[3];
        $this->city = $input[4];
        $this->clinikAddress = $input[5];
        $this->major = $input[6];
        $this->expertise = $input[7];
        $this->emailAddress = $input[8];
        $this->gender = $input[9];
    }




    
    public function isEmpty(){
        if ( empty($this->fname) || empty($this->lname) || empty($this->fileNumber) || empty($this->number) || empty($this->city) || empty($this->clinikAddress) || empty($this->major) || empty($this->expertise) || empty($this->emailAddress) || empty($this->gender) ) {
            return false;
        }else {
            return true;
        }
    }








    // proper name without number and having suitable amount of char 3-31
    public function validName(){
        $fname = str_split($this->fname);
        $lname = str_split($this->lname);
        $isNumeric = false;
        $numArray = [1,2,3,4,5,6,7,8,9];
        for ($i=0; $i <count($fname) ; $i++) { 
            foreach ($numArray as $value) {
                if ($value == $fname[$i]) {
                    $isNumeric = true;
                    break;
                }
            }
        }

        for ($j=0; $j <count($lname) ; $j++) { 
            foreach ($numArray as $value) {
                if ($value == $lname[$j]) {
                    $isNumeric = true;
                    break;
                }
            }
        }
        if ((array_key_last($fname) > 31) || (array_key_last($lname) > 31) || ($isNumeric == true) || (array_key_last($fname)<2) ||(array_key_last($lname)<2)) {
            return false; 
        }else{
            return true;
        }
    } 





    // certain amount of char and number's
    public function validFileNumber(){
        str_replace(" ","",$this->fileNumber);
        $fileNumber = str_split($this->fileNumber);

        if (count($fileNumber) !== 10) {
            return false;
        }else{
            return true;
        }
    }
    




    // phone number must be 11 char and start with 09 and not contain anything rather than nubmer's 
    public function validPhoneNumber(){
        $phoneNumber = str_split($this->number);
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




    //valid city that user have to choose in the list 
    public function city(){
        $city = file("Document/city.txt");
        $lowerCity = strtolower($this->city);
        $cityArray = array();
        foreach ($city as $value) {
            $holder = trim($value);
            array_push($cityArray,strtolower($holder));
        }
        if (!in_array($lowerCity,$cityArray)) {
            return false;
        }
        return true;
    }




    //valid major in medical fields that use have to choose in the list
    public function validmajor(){
        $major = file("Document/major.txt");
        $lowerMajor = strtolower($this->major);
        $majorArray = array();
        foreach ($major as $value) {
            $holder = trim($value);
            array_push($majorArray,strtolower($holder));
        }
        if (!in_array($lowerMajor,$majorArray)) {
            return false;
        }
        return true;
    }




    public function validEmail(){
        if (filter_var($this->emailAddress,FILTER_VALIDATE_EMAIL) == false) {
            return false;
        }
        return true;
        
    }




    public function gender(){

        if ($this->gender ==  "male" || $this->gender == "female" ) {
            return true;
        }

        return false;
    }


    public static function password($input){
        //bigger than 8 , smaller than 31 , have both character and number's 
        $number = "0123456789";
        $numberArray =  str_split($number);
        $character = "abcdefghijklmnopqrstuvwxyz";
        $charArray = str_split($character);
        $inputArray = str_split($input);
        if (strlen($input)<8 || strlen($input)>31 ) {
            return false;
        }

        //check if it has integer
        $includeNum = false;
        foreach ($inputArray as  $value) {
            if (in_array($value,$numberArray)) {
                $includeNum = true;
            }
        }
        if ($includeNum == false) {
            return false;
        }

        //check if it has char
        $includeChar = false;
        foreach ($inputArray as  $value) {
            if (in_array($value,$charArray)) {
                $includeChar = true;
            }
        }
        if ($includeChar == false) {
            return false;
        }
        return true;
    }

}
