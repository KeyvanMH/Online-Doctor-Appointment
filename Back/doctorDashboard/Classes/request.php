<?php
class request{
    public static function requestFinder($uri){
        $uriArray = explode("?",$uri);
        unset($uriArray[0]);
        $output = implode("?",$uriArray);
        return $output;
    }
    public static function requestDelete($request){
        $requestArray = explode("?",$request);
        //count the number of request to be just one
        $num = count($requestArray);
        if ($num !== 1) {
            errorHandling::inValidRequest();
        }

        
        //validate the request to has the form like 'AppointmentID=number'
        $match = preg_match_all('/^AppointmentID=/',$request);
        if ($match !== 1) {
            errorHandling::inValidRequest();
        }

        //validate if appinointment
        $output = explode('=',$request);
        $outputNum = count($output);
        if ($outputNum > 2) {
            errorHandling::inValidRequest();
        }
        $appointmentID = $output[1];
        //validate appointment id to be just number's
        
        $number = str_split('1234567890');
        $char = str_split($appointmentID);
        foreach ($char as $i) {
            foreach ($number as $j) {
                if ($i == $j) {
                    $valid = true;
                    break;                    
                }elseif ($i !== $j) {
                    $valid = false;
                }
            }
            if ($valid == false) {
                errorHandling::inValidRequest();
            }
        }
        return $appointmentID;
    }

    public static function requestPut(){}
    
}