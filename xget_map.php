<?php //xget_map.php 20180314
    session_start();
    require 'xsql_connection.php';

    $floor_id = $_POST["floor_id"];
    $data     = array();

    $sql    = "SELECT  floor_id 
                      ,url
                      ,canvas
                FROM floors
               WHERE floor_id = '$floor_id'  
              ";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()){
            $url    = $row["url"];
            $canvas = $row["canvas"];
        }
    }

    $data["answer"] = $url . $canvas;

    $conn->close();

    echo json_encode($data);    

