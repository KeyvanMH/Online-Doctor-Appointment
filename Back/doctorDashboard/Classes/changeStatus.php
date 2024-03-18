<?php
class changeStatus{
    public static function changeStatus($input){
        // live time
        $year = "20".date("y");
        $month = date("m");
        $day = date("d");
        $hour = date("h");
        $minute = date("i");
        //input time
        foreach ($input as $key => $value){
            $appointmentId = array();
            $monthArray = explode("-","January-February-March-April-May-June-July-August-September-October-November-December");
            foreach ($monthArray as $key => $index) {
                if (strtolower($index) == strtolower($value['month'])) {
                    $dbMonth = $key;
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
                array_push($appointmentId,$value['appointment_id']);
                break;
            }
            if ($year == $value['year'] and $month > $dbMonth) {
                //status == 0
                array_push($appointmentId,$value['appointment_id']);
                break;
            }
            if ($year == $value['year'] and $month == $dbMonth and $day > $value['day']) {
                //status == 0
                array_push($appointmentId,$value['appointment_id']);
                break;
            }
            if ($year == $value['year'] and $month == $dbMonth and $day == $value['day'] and $hour > $dbHour ) {
                //status == 0
                array_push($appointmentId,$value['appointment_id']);
                break;
            }
            if ($year == $value['year'] and $month == $dbMonth and $day == $value['day'] and $hour == $dbHour  and $minute > $dbMinute) {
                //status == 0
                array_push($appointmentId,$value['appointment_id']);
                break;
            }


        }
        return $appointmentId;
    }
}