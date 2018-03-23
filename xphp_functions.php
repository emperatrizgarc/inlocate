<?php


function form_sql_filters_conditions($filters) {

    $start_date    = null;
    $end_date      = null;
    $creation_date = null;

    $filters = json_decode($filters);

    foreach ($filters as $key => $value) {
        if ($value->value != "") {

            if ($value->name == "start_date_eu") {
                $start_date = $value->value;
                $start_date = date_format(date_create($start_date), "Y-m-d"); 
            } elseif ($value->name == "end_date_eu") {
                $end_date = $value->value;
                $end_date = date_format(date_create($end_date), "Y-m-d");
            } else {
                if (strpos($value->name, "date")) {
                    $query .= "(select convert(" . $value->name . ", date)) like '%" . date_format(date_create($value->value), "Y-m-d") .  "%' and "; 
                } else {
                    $query .= $value->name . " like '%" . $value->value.  "%' and "; 
                } 
            }
        }

        if (strpos($value->name, ".")) {

            $creation = explode(".", $value->name);

            if (in_array("creation_date", $creation)) {
                $creation_date = $value->name;
            }     
        } else {

            $creation = explode("_", $value->name);

            if (in_array("creation", $creation)) {
                $creation_date = $value->name;
            }   
        }          
    }

    //$creation_date = "creation_date";

    if (!is_null($start_date) && !is_null($end_date)) {
        //$start_date = "(select convert('$start_date', date))";
        //$end_date   = "(select convert('$end_date', date))";
        $range      = "(select convert(".$creation_date.", date)) between '" . $start_date . "' and '" . $end_date . "' and ";
        $query     .= $range; 
    } elseif (!is_null($start_date)) {
        //$start_date = "(select convert('$start_date', date))";
        $range      = "(select convert(".$creation_date.", date)) >= '" . $start_date . "' and ";
        $query     .= $range; 

    } elseif (!is_null($end_date)) {
        //$end_date   = "(select convert('$end_date', date))";
        $range      = "(select convert(".$creation_date.", date)) <= '" . $end_date . "' and ";
        $query     .= $range; 
    } else {

    }

    $find    = "and";
    $replace = "";
    $query   = strrev(preg_replace(strrev("/$find/"),strrev($replace),strrev($query),1));

    return $query;
}

function round_up($value, $places=0) {
    if ($places < 0) { $places = 0; }
    $mult = pow(10, $places);
    return ceil($value * $mult) / $mult;
}

function round_out($value, $places=0) {
    if ($places < 0) { $places = 0; }
    $mult = pow(10, $places);
    return ($value >= 0 ? ceil($value * $mult):floor($value * $mult)) / $mult;
}


function verify_color($conn, $color) {

    $sql    = "SELECT color
                FROM  users 
                WHERE color = '$color'
               ";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $exists = 1;    
    } else {
        $exists = 0;
    } 

    return $exists;
}

function random_color_part() {
    return str_pad( dechex( mt_rand( 0, 255 ) ), 2, '0', STR_PAD_LEFT);
}

function random_color() {
    return "#".random_color_part() . random_color_part() . random_color_part();
}