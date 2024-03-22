<?php
class validation{
    public static function validation($filterCity,$filterMajor,$filterGender){
        //validate gender 
        if ($filterGender !== null) {
            $gender = ['male','female'];
            if (!in_array($filterGender,$gender)) {
                errorHandling::inValidRequest();
            }
        }

        //validate city
        if ($filterCity !== null) {
            $city = file("../SignupDoc/Document/city.txt");
            $lowerCity = strtolower($filterCity);
            $cityArray = array();
            foreach ($city as $value) {
                $holder = trim($value);
                array_push($cityArray,strtolower($holder));
            }
            if (!in_array($lowerCity,$cityArray)) {
                errorHandling::inValidRequest();
            }
        }
        
        //validate major
        if ($filterMajor !== null) {
            $city = file("../SignupDoc/Document/major.txt");
            $lowerCity = strtolower($filterCity);
            $cityArray = array();
            foreach ($city as $value) {
                $holder = trim($value);
                array_push($cityArray,strtolower($holder));
            }
            if (!in_array($lowerCity,$cityArray)) {
                errorHandling::inValidRequest();
            }
        }




    }


    
}