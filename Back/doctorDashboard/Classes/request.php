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



    public static function requestPut($request){
        $requestArray = explode("&",$request);
        if (count($requestArray) !== 4) {
            errorHandling::inValidRequest();
        }
        $match = preg_match_all('/=/',$request);
        if ($match !== 4) {
            errorHandling::inValidRequest();
        }
        $year = '20'.date('y');
        foreach ($requestArray as  $value) {
            $tmp = explode("=",$value);
            switch ($tmp[0]) {
                case 'year':
                    //check if the year of appointment is not in the past
                    $charNum = str_split($tmp[1]);
                    if (count($charNum) !== 4) {
                        errorHandling::inValidRequest();
                    }
                    if ($tmp[1] < $year) {
                        errorHandling::inValidRequest();
                    }         
                    break;
                
                case 'month':
                    //check input month to be only of these month's 
                    $month = "January-February-March-April-May-June-July-August-September-October-November-December";
                    $monthArray = explode("-",$month);
                    $num = count($monthArray);
                    $requestMonth = strtolower($tmp[1]);
                    for ($i=0; $i < $num ; $i++) { 
                        $monthArray[$i] = strtolower($monthArray[$i]);
                    }

                    foreach ($monthArray as $value) {
                        if ($value == $requestMonth) {
                            $isValid = true;
                            break;
                        }
                        $isValid = false;
                    }

                    if ($isValid == false) {
                        errorHandling::inValidRequest();
                    }
                    break;
                
                case 'day':
                    //format of the day must be 2 number only
                    $dayArray = str_split($tmp[1]);
                    $charNum = count($dayArray);
                    if ($charNum !== 2) {
                        errorHandling::inValidRequest();
                    }
                    //check input to be just number and not character's
                    $number = '1234567890';
                    $numberArray = str_split($number);
                    foreach ($dayArray as  $i) {
                        foreach ($numberArray as  $j) {
                            $isValid = false;
                            if ($i == $j) {
                                $isValid = true;
                                break;
                            }
                        }
                        if ($isValid == false) {
                            errorHandling::inValidRequest();
                        }
                    }
                    //check the day to not be bigger than 31
                    if ($tmp[1] > 31) {
                        errorHandling::inValidRequest();
                    }
                    break;
                
                case 'hour':
                    $isValid = preg_match_all('/^\d{2}:\d{2}-\d{2}:\d{2}$/',$tmp[1]);
                    if ($isValid !== 1) {
                        errorHandling::inValidRequest();
                    }
                    break;
                
                default:
                errorHandling::inValidRequest();
                    break;
            }


            

        }

    }
    
}