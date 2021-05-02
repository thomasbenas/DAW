<?php 

function dateInFrenchFormat($date){
        $date = date_create($date); 
        return date_format($date , 'd/m/Y');
}

function dateOnlyHoursAndMinutes($date){
    $date = date_create($date); 
    return date_format($date , 'G:i:s');
}