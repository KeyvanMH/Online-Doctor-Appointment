<?php
class changeStatus{
    public static function changeStatus($time){
        if ($time !== null) {
        // live time
        $year = "20".date("y");
        $month = date("m");
        $day = date("d");
        $hour = date("G");
        $minute = date("i");
        //input time
        $appointmentId = array();
        foreach ($time as $key => $value){
            $monthArray = explode("-","January-February-March-April-May-June-July-August-September-October-November-December");
            foreach ($monthArray as $key => $index) {
                if (strtolower($index) == strtolower($value['month'])) {
                    $dbMonth = $key+1;
                    break;
                }
            }
            // compare db time with current time 
            $temp = explode("-",$value['hour']);
            $array = explode(":",$temp[0]);
            $dbHour = $array[0];
            $dbMinute = $array[1];
            
            if ($year > $value['year']) {
                //status == 0
                array_push($appointmentId,$value['id']);
                // continue;
            }
            if ($year == $value['year'] and $month > $dbMonth) {
                //status == 0
                array_push($appointmentId,$value['id']);
                continue;
            }
            if ($year == $value['year'] and $month == $dbMonth and $day > $value['day']) {
                //status == 0
                array_push($appointmentId,$value['id']);
                continue;
            }
            if ($year == $value['year'] and $month == $dbMonth and $day == $value['day'] and $hour > $dbHour ) {
                //status == 0
                array_push($appointmentId,$value['id']);
                continue;
            }
            if ($year == $value['year'] and $month == $dbMonth and $day == $value['day'] and $hour == $dbHour  and $minute > $dbMinute) {
                //status == 0
                array_push($appointmentId,$value['id']);
                continue;
            }


        }
        return $appointmentId;
    }
    }
}