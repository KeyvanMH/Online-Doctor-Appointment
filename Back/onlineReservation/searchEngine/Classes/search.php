<?php
class search{
    public static function search($input,array $dbResult):array{
        $input = htmlspecialchars(strtolower($input));
        $nameMatch = array();   
        $cityMatch = array();
        $majorMatch = array();
        $addressMatch = array();
        //search if $input exist in the beginning of the value      
        foreach ($dbResult as $key => $value) {
            $match = "/^".$input."/";
            if(preg_match($match,strtolower($value['last_name']))){
                array_push($nameMatch,$key);
            }
            if(preg_match($match,strtolower($value['major']))){
                array_push($majorMatch,$key);
            }
            if(preg_match($match,strtolower($value['clinic_address']))){
                array_push($addressMatch,$key);
            }
            if(preg_match($match,strtolower($value['city']))){
                array_push($cityMatch,$key);
            }
            if(preg_match($match,strtolower($value['first_name']))){
                if (!in_array($key,$nameMatch)) {
                    array_push($nameMatch,$key);
                }
            }
        }
        //search if $input exist in the middile of the value      
        foreach ($dbResult as $key => $value) {
            $match = "/".$input."/";
            if(preg_match($match,strtolower($value['last_name']))){
                if (!in_array($key,$nameMatch)) {
                    array_push($nameMatch,$key);
                }
            }
            if(preg_match($match,strtolower($value['first_name']))){
                if (!in_array($key,$nameMatch)) {
                    array_push($nameMatch,$key);
                }
            }
            if(preg_match($match,strtolower($value['city']))){
                if (!in_array($key,$cityMatch)) {
                    array_push($cityMatch,$key);
                }
            }
            if(preg_match($match,strtolower($value['major']))){
                if (!in_array($key,$majorMatch)) {
                    array_push($majorMatch,$key);
                }
            }
            if(preg_match($match,strtolower($value['clinic_address']))){
                if (!in_array($key,$addressMatch)) {
                    array_push($addressMatch,$key);
                }
            }

        }
        //return part : by defualt sorted by relevant
        $outputName = array();
        $outputCity = array();
        $outputMajor = array();
        $outputAddress = array();
        foreach ($nameMatch as $key => $value) {
            array_push($outputName,$dbResult[$value]);
        }
        foreach ($cityMatch as $key => $value) {
            array_push($outputCity,$dbResult[$value]);
        }
        foreach ($majorMatch as $key => $value) {
            array_push($outputMajor,$dbResult[$value]);
        }
        foreach ($addressMatch as $key => $value) {
            array_push($outputAddress,$dbResult[$value]);
        }
        
        return ["name"=>$outputName,"city"=>$outputCity,"major"=>$outputMajor,"address"=>$outputAddress];
    }
}
