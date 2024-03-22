<?php
class sort{
    public static function sort($dbArray,$sort){
    switch ($sort) {
        case 'relevant':
            return $dbArray;
        
        case 'alphabaticAscending':
            //sort by alphabatet from a 
            asort($dbArray);
            return $dbArray;
        
        case 'alphabaticDescending':
            //sort by alphabatet from z
            rsort($dbArray);
            return $dbArray;
        
        default:
        errorHandling::inValidRequest();
            break;
    }        
    }
}