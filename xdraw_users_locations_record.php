<?php //xdraw_locations.php 20180312
    session_start();
    require 'xsql_connection.php';
    include 'xphp_functions.php';
    
    $user_id = $_POST["user_id"];
    $data    = array();
    $rows    = "";
    $query   = "";
    $default = "";
    $counter = 0;
    $current = 0;

    $user_locations = array();
    $array_colors   = array(); 

    if ($user_id != "") {
        $sql    = "SELECT  u.user_id
	                      ,ul.x_location
	                      ,ul.y_location
	                      ,ul.creation_date
	                      ,u.color
	                 FROM user_locations ul
	                      inner join users u on u.user_id = ul.user_id
	                WHERE u.user_id = '$user_id'
	                GROUP BY u.user_id
	                      ,ul.x_location
	                      ,ul.y_location
	                ORDER BY ul.creation_date ASC 
	               ";
    } else {
        $sql    = "SELECT  u.user_id
	                      ,ul.x_location
	                      ,ul.y_location
	                      ,ul.creation_date
	                      ,u.color
	                 FROM user_locations ul
	                      inner join users u on u.user_id = ul.user_id
	                WHERE true
	                GROUP BY u.user_id
	                      ,ul.x_location
	                      ,ul.y_location
	                ORDER BY ul.creation_date ASC 
	               ";  
    }

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
        	$counter += 1;
        	$user_locations[$counter] = array("user_id" => $row["user_id"],
        									  "xp" 		=> $row["x_location"],
        									  "yp" 		=> $row["y_location"],
        									  "color" 	=> $row["color"]
        									);

        }
    }

    $data["answer"] = $user_locations;

    $conn->close();

    echo json_encode($data);    

