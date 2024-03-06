<?php
class request{
    public static function requestFinder($uri){
        $uriArray = explode("?",$uri);
        unset($uriArray[0]);
        $output = implode("?",$uriArray);
        return $output;
    }



    public static function requestDelete($request){
        $requestArray = explode("&",$request);
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
        //this part is to validate syntax of the uri 
        $requestArray = explode("&",$request);
        if (count($requestArray) !== 4) {
            errorHandling::inValidRequest();
        }
        $match = preg_match_all('/=/',$request);
        if ($match !== 4) {
            errorHandling::inValidRequest();
        }
        //current year
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
                    $year = $tmp[1];
                    break;
                
                case 'month':
                    //check input month to be only of these month's 
                     /**
                    * @param int $outputMonth is the number of the input month in 
                     */
                    $month = "January-February-March-April-May-June-July-August-September-October-November-December";
                    $monthArray = explode("-",$month);
                    $num = count($monthArray);
                    $requestMonth = strtolower($tmp[1]);
                    for ($i=0; $i < $num ; $i++) { 
                        $monthArray[$i] = strtolower($monthArray[$i]);
                    }

                    foreach ($monthArray as $key => $value) {
                        if ($value == $requestMonth) {
                            $outputMonth = $key+1;
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
                    $day = $tmp[1];
                    break;
                
                case 'hour':
                    $isValid = preg_match_all('/^\d{2}:\d{2}-\d{2}:\d{2}$/',$tmp[1]);
                    if ($isValid !== 1) {
                        errorHandling::inValidRequest();
                    }
                    $holder = explode("-",$tmp[1]);
                    foreach ($holder as  $value) {
                        $digit = explode(":",$value);
                        foreach ($digit as  $number) {
                            if ($digit[0] >= 24) {
                                errorHandling::inValidRequest();
                            }
                            if ($digit[1] >= 60) {
                                errorHandling::inValidRequest();
                            }

                        }
                    }
                    $hour = $tmp[1];
                    break;
                
                default:
                errorHandling::inValidRequest();
                    break;
            }
        }
        /**      Now we start to validate these params that we got from the request *not to be in past time
               * @param $year 
               * @param $outputMonth 
               * @param $hour 
               * @param $day 
          */
        //real time Now:
        $thisYear = '20'.date('y');
        $thisMonth = date('m');
        $thisDay = date('d');
        $thisMinute = date('i');
        
       
        if ($year == $thisYear and $outputMonth<$thisMonth) {
            errorHandling::inValidRequest();            
        }
        if ($year == $thisYear and $outputMonth == $thisMonth and $thisDay>$day) {
            errorHandling::inValidRequest();
        }
        // split hour to number 
        $thisHour = date('H');
        $hourArray = explode('-',$hour);
        $hourNum = explode(':',$hourArray[0]);
        if ($year == $thisYear and $outputMonth == $thisMonth and $thisDay == $day and $thisHour>$hourNum[0]) {
            errorHandling::inValidRequest();
        }
        if ($year == $thisYear and $outputMonth == $thisMonth and $thisDay == $day and $thisHour == $hourNum[0] and $thisMinute>$hourNum[1]) {
            errorHandling::inValidRequest();
        }

        //this part is to validate the the a is greater than b => aa:aa-bb:bb
        $firstClock = $hourArray[0];
        $secondClock = $hourArray[1];
        $firstClockArray = explode(':',$firstClock);
        $secondClockArray = explode(':',$secondClock);

        $firstClockHour = $firstClockArray[0];
        $firstClockMin = $firstClockArray[1];
        $secondClockHour = $secondClockArray[0];
        $secondClockMin = $secondClockArray[1];

        if ($secondClockHour < $firstClockHour) {
            errorHandling::inValidRequest();
        }
        if ($secondClockHour == $firstClockHour and $secondClockMin <= $firstClockMin ) {
            errorHandling::inValidRequest();
        }

    }
    
}