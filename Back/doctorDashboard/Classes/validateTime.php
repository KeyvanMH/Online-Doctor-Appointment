<?php
class validateTime{
    public static function validTime($dbTimeArray,$inputHour){
        $request = explode("&",$inputHour);
        foreach ($request as  $value) {
            $temp = explode("=",$value);
            if ($temp[0] == 'hour') {
                $hour = $temp[1];
            }
        }
        //the hour of the request
        $holder = explode('-',$hour);
        $firstInputClock = $holder[0];
        $lastInputClock = $holder[1];
        $firstInputClockArray = explode(":",$firstInputClock);
        $lastInputClockArray = explode(":",$lastInputClock);
        // hour that got fetched from database
        $firstDbClockArray = array();
        $lastDbClockArray = array();
        $length = count($dbTimeArray);
        for ($i=0; $i < $length ; $i++) { 
            $temp = explode('-',$dbTimeArray[$i]['hour']);
            array_push($firstDbClockArray,$temp[0]);
            array_push($lastDbClockArray,$temp[1]);
        }
        foreach ($firstDbClockArray as $key => $value) {
            $firstDbClockArray[$key] = explode(':',$value);
        }
        foreach ($lastDbClockArray as $key => $value) {
            $lastDbClockArray[$key] = explode(':',$value);
        }
        //compare hour from database with hour from input
        //comparing appointment that has been reserverd before the input time to not have overlap
        $before = array();
        foreach ($firstDbClockArray as $key => $value) {
            if ($value[0] < $firstInputClockArray[0]) {
                array_push($before,$key);
            }
            if ($value[0] == $firstInputClockArray[0] and $value[1] <= $firstInputClockArray[1]) {
                array_push($before,$key);
            }
        }
        foreach ($before as $value) {
            if ($lastDbClockArray[$value][0] > $firstInputClockArray[0]) {
                errorHandling::inValidInput();
            }
            if ($lastDbClockArray[$value][0] == $firstInputClockArray[0] and $lastDbClockArray[$value][1] >= $firstInputClockArray[1]) {
                errorHandling::inValidInput();
            }
        }

        //comparing appointment that has been reserverd after the input time to not have overlap
        $after = array();
        foreach ($firstDbClockArray as $key => $value) {
            if ($value[0] > $firstInputClockArray[0]) {
                array_push($after,$key);
            }
            if ($value[0] == $firstInputClockArray[0] and $value[1] >= $firstInputClockArray[1]) {
                array_push($after,$key);
            }
        }
        foreach ($after as $value) {
            if ($firstDbClockArray[$value][0] < $lastInputClockArray[0] ) {
                errorHandling::inValidInput();
            }
            if ($firstDbClockArray[$value][0] == $lastInputClockArray[0] and $firstDbClockArray[$value][1] <= $lastInputClockArray[1]) {
                errorHandling::inValidInput();
            }

        }


    }
}