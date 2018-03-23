<?php //xget_last_location_per_user.php 20180312
    session_start();
    require 'xsql_connection.php';
    include 'xphp_functions.php';
 
    $user_id = $_POST["user_id"];
    $data    = array();
    $rows    = "";
    $query   = "";
    $default = "";
    $counter    = 0;
    $current    = 0;
    $sequence   = 0;

    $user_locations = array();
    $array_colors   = array(); 

    if ($user_id != "") {
        $sql    = "SELECT (
                            SELECT CONCAT(CAST(ul.x_location AS CHAR), ' ', CAST(ul.y_location AS CHAR))
                             FROM user_locations ul
                                  inner join users         u  on u.user_id          = ul.user_id
                            WHERE ul.user_id = u.user_id
                            ORDER BY ul.creation_date DESC
                            LIMIT 1
                          ) location 
                          ,u.user_id
                          ,u.color
                     FROM users u
                     WHERE u.user_id = '$user_id'
                   ";
    } else {
        $sql    = "SELECT (
                            SELECT CONCAT(CAST(ul.x_location AS CHAR), ' ', CAST(ul.y_location AS CHAR))
                             FROM user_locations ul
                                  inner join users         u  on u.user_id          = ul.user_id
                            WHERE ul.user_id = u.user_id
                            ORDER BY ul.creation_date DESC
                            LIMIT 1
                          ) location 
                          ,u.user_id
                          ,u.color
                     FROM users u
                     WHERE true
                   ";    
    }

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {

            $location   = explode(" ", $row["location"]);
            $x_location =  $location[0];
            $y_location =  $location[1];

        	$counter += 1;

        	$user_locations[$counter] = array("user_id" => $row["user_id"],
        									  "xp" 		=> $x_location,
        									  "yp" 		=> $y_location,
        									  "color" 	=> $row["color"]
        									);

        }
    }


    $data["answer"] = $user_locations;

    $conn->close();

    echo json_encode($data);    

